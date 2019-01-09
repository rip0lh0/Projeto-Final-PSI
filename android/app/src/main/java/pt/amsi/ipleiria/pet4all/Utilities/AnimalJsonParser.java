package pt.amsi.ipleiria.pet4all.Utilities;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Models.Animal;

public class AnimalJsonParser {

public static ArrayList<Animal>parserJsonAnimals(JSONArray response,Context context){
    ArrayList<Animal> tempAnimalList=new ArrayList<>();
    try {
        for (int i = 0; i < response.length(); i++) {
            JSONObject animal = (JSONObject) response.get(i);
            int idAnimal = (int) animal.get("id");
            String name = animal.getString("name");
            String description = animal.getString("description");
            int breed =animal.getInt("breed");
            int coat=animal.getInt("coat");
            int size=animal.getInt("size");
            int energy=animal.getInt("energy");
            String chip = animal.getString("chip");
            int neutered=animal.getInt("neutered");
            int gender=animal.getInt("genero");
            int weight=animal.getInt("weight");
            int age=animal.getInt("age");
            String created_at=animal.getString("created_at");
            String updated_at=animal.getString("updated_at");
            int status=animal.getInt("status");

            Animal auxAnimal=new Animal(idAnimal,name,description,
                    breed,coat,size,energy,chip,neutered,gender,weight,age
            ,created_at,updated_at,status);
            tempAnimalList.add(auxAnimal);
        }
    }
        catch (JSONException ex){
            ex.printStackTrace();
            Toast.makeText(context,"Error:"+ex.getMessage(),Toast.LENGTH_SHORT).show();
        }
        return tempAnimalList;
    }

    public static Animal parserJsonAnimals(String response, Context context){
        Animal animalAux = null;
        try{
            JSONObject animal = new JSONObject(response);

            int idAnimal = (int) animal.get("id");
            String name = animal.getString("name");
            String description = animal.getString("description");
            int breed =animal.getInt("breed");
            int coat=animal.getInt("coat");
            int size=animal.getInt("size");
            int energy=animal.getInt("energy");
            String chip = animal.getString("chip");
            int neutered=animal.getInt("neutered");
            int gender=animal.getInt("genero");
            int weight=animal.getInt("weight");
            int age=animal.getInt("age");
            String created_at=animal.getString("created_at");
            String updated_at=animal.getString("updated_at");
            int status=animal.getInt("status");

           animalAux=new Animal(idAnimal,name,description,
                    breed,coat,size,energy,chip,neutered,gender,weight,age
                    ,created_at,updated_at,status);
        }
        catch (JSONException ex){
            ex.printStackTrace();
            Toast.makeText(context, "Error:" + ex.getMessage(), Toast.LENGTH_SHORT).show();

        }
        return animalAux;


    }

    public static boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        return  networkInfo != null && networkInfo.isConnected();
    }
}

