package pt.amsi.ipleiria.pet4all.Singletons;

import android.content.Context;
import android.util.Log;
import android.widget.Toast;

import com.android.volley.Request;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.Helpers.AnimalsDBHelper;
import pt.amsi.ipleiria.pet4all.Interfaces.ListListener;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.ResponseManager;

public class AnimalSingleton implements ListListener<Animal> {
    private static AnimalSingleton INSTANCE = null;

    private final String URL = "animal/";

    private ArrayList<Animal> animalList;
    private AnimalsDBHelper animalsDBHelper = null;
    private static ConnectionManager connectionMng;
    private ListListener<Animal> listListener = null;

    public static synchronized AnimalSingleton getInstance(Context context){
        if(INSTANCE == null){
            connectionMng = new ConnectionManager(context);
            INSTANCE = new AnimalSingleton(context);
        }
        return INSTANCE;
    }

    private AnimalSingleton(Context context){
        this.animalList = new ArrayList<Animal>();
        animalsDBHelper = new AnimalsDBHelper(context);
    }

    public Animal getAnimal(long idAnimal){
        for(Animal animal : animalList){
            if(animal.getId() == idAnimal) return animal;
        }
        return null;
    }

    public ArrayList<Animal> getAnimalBD(){
        animalList = animalsDBHelper.getAllAnimalsDB();
        return animalList;
    }

    public void addAnimalDB(Animal animal){
        animalsDBHelper.addAnimalDB(animal);
    }

    public void addAnimalsDB(ArrayList<Animal> animalList){
        for(Animal animal : animalList){
            addAnimalDB(animal);
        }
    }

    public void removeAnimalBD(long idAnimal)
    {
        Animal auxAnimal = getAnimal(idAnimal);
        if(auxAnimal != null)
            if(animalsDBHelper.removeAnimalDB(auxAnimal.getId()))
                animalList.remove(auxAnimal);
    }

    public void removerAnimalsDB(){
        animalsDBHelper.removeAllAnimalsDB();
    }

    public void editarAnimalDB(Animal animal)
    {
        if(!animalList.contains(animal)) return;

        Animal auxAnimal = getAnimal(animal.getId());

        auxAnimal.setName(animal.getName());
        auxAnimal.setDescription(animal.getDescription());
        auxAnimal.setCoat(animal.getCoat());
        auxAnimal.setEnergy(animal.getEnergy());
        auxAnimal.setSize(animal.getSize());
        auxAnimal.setChip(animal.getChip());
        auxAnimal.setAge(animal.getAge());
        auxAnimal.setGender(animal.getGender());
        auxAnimal.setWeight(animal.getWeight());
        auxAnimal.setNeutered(animal.getNeutered());
        auxAnimal.setId_kennel(animal.getId_kennel());
        auxAnimal.setCreated_at(animal.getCreated_at());

        if(animalsDBHelper.editAnimalDB(auxAnimal))
            System.out.println("Animal adicionado");
    }

    /* Retrieve All Animal Form API */
    public void getAllAnimal(final Context context){
        animalList = animalsDBHelper.getAllAnimalsDB();
        if (listListener != null) {
            listListener.onRefreshList(animalList);
        }
        if(ConnectionManager.checkInternetConnection(context)) {
            connectionMng.makeRequest(Request.Method.GET, this.URL, null, new ResponseManager() {
                @Override
                public void onResponse(JSONObject response) {
                    try {
                        JSONArray arrAnimals = response.getJSONArray("success");
                        Log.e("ANIMAL_RESPONSE", arrAnimals.toString());

                        animalList = Animal.parseJSONAnimals(arrAnimals, context);
                        removerAnimalsDB();
                        addAnimalsDB(animalList);
                    } catch (JSONException e) {
                        Log.e("ANIMAL_RESPONSE_ERROR", e.toString());
                    }

                    if (listListener != null) {
                        listListener.onRefreshList(animalList);
                    }
                }

                @Override
                public void onError(String message) {
                    if (listListener != null) listListener.onRefreshList(animalList);
                }
            });
        }
    }

    public void setListListener(ListListener<Animal> animalListListener){
        this.listListener = animalListListener;
    }

    @Override
    public void onRefreshList(ArrayList<Animal> list) {

    }

    @Override
    public void onUpdateList(Animal item, int operacao) {

    }
}
