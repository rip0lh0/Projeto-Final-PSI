package pt.amsi.ipleiria.pet4all.Singleton;
import java.util.ArrayList;
import android.content.Context;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import pt.amsi.ipleiria.pet4all.Listeners.AnimalsListener;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.Models.AnimalDBHelper;

public class SingletonAnimals implements AnimalsListener {
    private static SingletonAnimals INSTANCE = null;
    private ArrayList<Animal> animalList;
    private AnimalDBHelper animalDBHelper=null;

    private static RequestQueue volleyQueue =null;

    private String mUrlApiAnimals = "";
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
    /*public ArrayList<Animal> getAnimalsDB(){
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
    public void removeAnimalDB(long idAnimal)
    {
        Animal auxAnimal = getAnimal(idAnimal);
        if(auxAnimal != null)
            if(animalDBHelper.removeAnimalDB(auxAnimal.getId()))
                animalList.remove(auxAnimal);
    }
    public void removeAnimalsDB(long idAnimal)
    {
        animalDBHelper.removeAllAnimalsDB();
    }
    public void editAnimalsDB(Animal animal){
        if(!animalList.contains(animal)){
            return;
        }
        Animal auxAnimal= getAnimal(animal.getId());
        //auxAnimal.setImage(animal.getImage());
        auxAnimal.setName(animal.setName)
    }*/
}
