package pt.amsi.ipleiria.pet4all.Singleton;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;

import pt.amsi.ipleiria.pet4all.Listeners.AnimalsListener;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.Models.AnimalDBHelper;
import pt.amsi.ipleiria.pet4all.Utilities.AnimalJsonParser;

public class SingletonAnimals implements AnimalsListener {
    private static SingletonAnimals INSTANCE = null;
    private ArrayList<Animal> animalList;
    private AnimalDBHelper animalDBHelper=null;

    private static RequestQueue volleyQueue =null;

    private String mUrlApiAnimals = "192.168.43.186/v1/animal";
    private String mUrlApiLogin = "";
    private AnimalsListener animalsListener;

    public static synchronized SingletonAnimals getInstance(Context context){
        if (INSTANCE==null){
            INSTANCE= new SingletonAnimals(context);
            volleyQueue=Volley.newRequestQueue(context);
        }
        return INSTANCE;
    }
    public SingletonAnimals(Context context){
        animalList=new ArrayList<>();
        animalDBHelper=new AnimalDBHelper(context);
    }
    public Animal getAnimal(long idAnimal){
        for (Animal animal : animalList){
            if (animal.getId()==idAnimal)
                return animal;

        }
        return null;
    }
    public ArrayList<Animal> getAnimalsDB(){
        animalList=animalDBHelper.getAllAnimalsDB();
        return animalList;
    }
    public void addAnimalDB(Animal animal){
        animalDBHelper.addAnimalDB(animal);
    }
    public void addAnimalsDB(ArrayList<Animal>animalList){
        removeAnimalsDB();
        for (Animal animal : animalList){
            addAnimalDB(animal);
        }
    }
    public void setAnimalsListener(AnimalsListener animalsListener){
        this.animalsListener = animalsListener;
    }
    public void removeAnimalDB(long idAnimal)
    {
        Animal auxAnimal = getAnimal(idAnimal);
        if(auxAnimal != null)
            if(animalDBHelper.removeAnimalDB(auxAnimal.getId()))
                animalList.remove(auxAnimal);
    }
    public void removeAnimalsDB()
    {
        animalDBHelper.removeAllAnimalsDB();
    }
    public void editAnimalsDB(Animal animal){
        if(!animalList.contains(animal)){
            return;
        }
        Animal auxAnimal= getAnimal(animal.getId());
        //auxAnimal.setImage(animal.getImage());
        auxAnimal.setName(animal.getName());
        auxAnimal.setDescription(animal.getDescription());
        auxAnimal.setCoat(animal.getCoat());
        auxAnimal.setSize(animal.getSize());
        auxAnimal.setEnergy(animal.getEnergy());
        auxAnimal.setChip(animal.getChip());
        auxAnimal.setNeutered(animal.getNeutered());
        auxAnimal.setGender(animal.getGender());
        auxAnimal.setWeight(animal.getWeight());
        auxAnimal.setAge(animal.getAge());
        auxAnimal.setCreated_at(animal.getCreated_at());
        auxAnimal.setUpdated_at(animal.getUpdated_at());
        auxAnimal.setStatus(animal.getStatus());
    }

    public void getAllAnimalsAPI(final Context context, boolean isConnected){
        Toast.makeText(context, "Is connected:" + isConnected, Toast.LENGTH_SHORT).show();
        if(!isConnected){
            animalList = animalDBHelper.getAllAnimalsDB();
            if(animalsListener != null){
                animalsListener.onRefreshAnimalsList(animalList);
            }
        }
        else{
            JsonArrayRequest req = new JsonArrayRequest(Request.Method.GET, mUrlApiAnimals, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    System.out.println("Resposta--->" + response);
                    animalList = AnimalJsonParser.parserJsonAnimals(response, context);
                    addAnimalsDB(animalList);

                    if(animalsListener != null)
                        animalsListener.onRefreshAnimalsList(animalList);
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {

                }
            });
            volleyQueue.add(req);
        }
    }

    public void addAnimalsAPI(final Animal animal, final Context context){
        StringRequest req = new StringRequest(Request.Method.POST, mUrlApiAnimals, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                System.out.println("---> Resposta add post: " + response);
                if(animalsListener != null)
                    animalsListener.onUpdateAnimalsListDB(AnimalJsonParser.parserJsonAnimals(response, context), 1);
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

            }
        })
        {
            @Override
            protected Map<String,String> getParams(){
                Map<String, String> params = new HashMap<>();
                params.put("token", "AMSI-TOKEN");
                params.put("name", animal.getName());
                params.put("description", animal.getDescription());
                params.put("breed", String.valueOf(animal.getBreed()));
                params.put("coat", ""+animal.getCoat());
                params.put("size", String.valueOf(animal.getSize()));
                params.put("energy", String.valueOf(animal.getEnergy()));
                params.put("chip", (animal.getChip()));
                params.put("neutered", String.valueOf(animal.getNeutered()));
                params.put("gender", String.valueOf(animal.getGender()));
                params.put("weight", String.valueOf(animal.getWeight()));
                params.put("age", String.valueOf(animal.getAge()));
                params.put("created_at", animal.getCreated_at());
                params.put("updated_at", animal.getUpdated_at());
                params.put("status", String.valueOf(animal.getStatus()));

                return  params;
            }
        };
        volleyQueue.add(req);
    }

    @Override
    public void onRefreshAnimalsList(ArrayList<Animal> animalsList) {

    }

    @Override
    public void onUpdateAnimalsListDB(Animal animal, int action) {
        switch (action){
            case 1:
                addAnimalDB(animal);
                break;
            case 2:
                editAnimalsDB(animal);
                break;
            case 3:
                removeAnimalDB(animal.getId());
                break;
        }
    }
}
