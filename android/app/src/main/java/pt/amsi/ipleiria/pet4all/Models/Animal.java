package pt.amsi.ipleiria.pet4all.Models;


import android.content.Context;
import android.content.ContextWrapper;
import android.graphics.Bitmap;
import android.util.Log;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.ArrayList;

public class Animal {
    private long id;
    private String name;
    private String description;
    private String coat; // Coat
    private String energy; // Energy
    private String size; // Size
    private String chip;
    private int age;
    private char gender;
    private double weight;
    private int neutered;
    private int id_kennel;
    private String created_at;
    private ArrayList<String> imagesPaths;

    public Animal(long id, String name, String description, String coat, String energy, String size, String chip, int age, char gender, double weight, int neutered, int id_kennel, String created_at, ArrayList<String> imagesPaths){
        this.id = id;
        this.name=name;
        this.description=description;
        this.coat=coat;
        this.energy=energy;
        this.size=size;
        this.chip=chip;
        this.age=age;
        this.gender=gender;
        this.weight=weight;
        this.neutered=neutered;
        this.imagesPaths = imagesPaths;
        this.id_kennel = id_kennel;
        this.created_at = created_at;
    }

    public int getId_kennel() {
        return id_kennel;
    }

    public void setId_kennel(int id_kennel) {
        this.id_kennel = id_kennel;
    }

    public String getCreated_at() {
        return created_at;
    }

    public void setCreated_at(String created_at) {
        this.created_at = created_at;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public void setCoat(String coat) {
        this.coat = coat;
    }

    public void setEnergy(String energy) {
        this.energy = energy;
    }

    public void setSize(String size) {
        this.size = size;
    }

    public void setChip(String chip) {
        this.chip = chip;
    }

    public void setAge(int age) {
        this.age = age;
    }

    public void setGender(String gender) {
        this.gender = gender.charAt(0);
    }

    public void setWeight(double weight) {
        this.weight = weight;
    }

    public void setNeutered(int neutered) {
        this.neutered = neutered;
    }

    public long getId() { return id; }

    public void setId(long id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public String getDescription() {
        return description;
    }

    public String getCoat() {
        return this.coat;
    }

    public String getEnergy() {
        return this.energy;
    }

    public String getSize() {
        return this.size;
    }

    public String getChip() {
        return chip;
    }

    public int getAge() {
        return age;
    }

    public String getGender() {
        return gender+"";
    }

    public double getWeight() {
        return weight;
    }

    public int getNeutered() {
        return neutered;
    }

    public String getImagePath(){
        return (imagesPaths != null) ? imagesPaths.get(0) : null;
    }

    public ArrayList<String> getImagesPaths(){
        return imagesPaths;
    }

    public static ArrayList<Animal> parseJSONAnimals(JSONArray response, Context context){
        ArrayList<Animal> tempListaLivros = new ArrayList<Animal>();
        try{
            for(int i = 0; i< response.length(); i++){

                String animal = response.get(i).toString();

                Animal tempAnimal = Animal.parserJsonAnimal(animal, context);

                if(tempAnimal == null) continue;
                tempListaLivros.add(tempAnimal);
            }
        }
        catch (JSONException ex){
            ex.printStackTrace();
            Toast.makeText(context, "Error:" + ex.getMessage(), Toast.LENGTH_SHORT).show();

        }
        return tempListaLivros;
    }

    public static Animal parserJsonAnimal(String response, Context context){
        Animal tempAnimal = null;
        try{
            JSONObject jObjAnimals = new JSONObject(response);

            int animal_id = jObjAnimals.getInt("id");
            String animal_name = jObjAnimals.getString("name");
            String animal_descrioption = null;
            int animal_age = 0;
            char animal_gender = ((String)jObjAnimals.get("gender")).charAt(0);
            double animal_weight = 0;
            int animal_neutered = 0;
            String animal_chip = (String)jObjAnimals.get("chip");
            ArrayList<String> animal_imagesPaths = new ArrayList<String>();

            String prefix_path = jObjAnimals.getString("id_kennel") + "/" + jObjAnimals.getString("created_at");

            JSONArray jArrImages = jObjAnimals.getJSONArray("images");

            for(int i = 0; i < jArrImages.length(); i++){
                JSONObject jObjImage = jArrImages.getJSONObject(i);

                String path = prefix_path + "/" + jObjImage.getString("name");

                animal_imagesPaths.add(path);
            }

            Log.e("IMAGES_ANIMAL", jArrImages.toString());


            try {
                animal_descrioption = jObjAnimals.getString("description");
            }catch (JSONException e){
                Log.e("JSON_ERROR", e.toString());
            }

            try {
                animal_age = jObjAnimals.getInt("age");
            }catch (JSONException e){
                Log.e("JSON_ERROR", e.toString());
            }

            try {
                animal_weight = jObjAnimals.getDouble("weight");
            }catch (JSONException e){
                Log.e("JSON_ERROR", e.toString());
            }

            try {
                animal_neutered = jObjAnimals.getInt("neutered");
            }catch (JSONException e){
                Log.e("JSON_ERROR", e.toString());
            }

            String animal_coat = jObjAnimals.getString("coat_size");
            String animal_energy = jObjAnimals.getString("energy");
            String animal_size = jObjAnimals.getString("size");

            int animal_id_kennel = jObjAnimals.getInt("id_kennel");
            String animal_created_at = jObjAnimals.getString("created_at");


            tempAnimal = new Animal(
                    animal_id,
                    animal_name,
                    animal_descrioption,
                    animal_coat,
                    animal_energy,
                    animal_size,
                    animal_chip,
                    animal_age,
                    animal_gender,
                    animal_weight,
                    animal_neutered,
                    animal_id_kennel,
                    animal_created_at,
                    animal_imagesPaths
            );
        }
        catch (JSONException ex){
            ex.printStackTrace();
            Toast.makeText(context, "Error:" + ex.getMessage(), Toast.LENGTH_SHORT).show();
        }

        return tempAnimal;
    }

}
