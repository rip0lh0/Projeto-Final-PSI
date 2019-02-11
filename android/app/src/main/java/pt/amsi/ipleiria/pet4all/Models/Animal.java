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
    private String name, description, chip;
    private String coat,energy, size;
    private int age;
    private char gender;
    private double weight;
    private int neutered;

    public Animal(long id, String name, String description, String coat, String energy, String size, String chip, int age, char gender, double weight, int neutered){
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

            long id = 0;
            String name = "", description = "", chip = "";
            String coat = "",energy = "", size = "";
            int age = 0;
            char gender = ' ';
            double weight = 0;
            int neutered = -1;

            id = jObjAnimals.getLong("id");
            name = jObjAnimals.getString("name");
            description = jObjAnimals.getString("description");

            coat = jObjAnimals.getString("coat");
            energy = jObjAnimals.getString("energy");
            size = jObjAnimals.getString("size");
            gender = jObjAnimals.getString("gender").charAt(0);

            try {
                chip = jObjAnimals.getString("chip");
            }catch (JSONException e){
                Log.e("JSON_ERROR", e.toString());
            }

            try {
                weight = jObjAnimals.getDouble("weight");
            }catch (JSONException e){
                Log.e("JSON_ERROR", e.toString());
            }

            try {
                neutered = jObjAnimals.getInt("neutered");
            }catch (JSONException e){
                Log.e("JSON_ERROR", e.toString());
            }

            tempAnimal = new Animal(
                    id,
                    name,
                    description,
                    coat,
                    energy,
                    size,
                    chip,
                    age,
                    gender,
                    weight,
                    neutered
            );
        }
        catch (JSONException ex){
            ex.printStackTrace();
            Log.e("JSON_ERROR", ex.toString());

            Toast.makeText(context, "Error:" + ex.getMessage(), Toast.LENGTH_SHORT).show();
        }

        return tempAnimal;
    }

    @Override
    public String toString() {
        return "Animal{" +
                "id=" + id +
                ", name='" + name + '\'' +
                ", description='" + description + '\'' +
                ", coat='" + coat + '\'' +
                ", energy='" + energy + '\'' +
                ", size='" + size + '\'' +
                ", chip='" + chip + '\'' +
                ", age=" + age +
                ", gender=" + gender +
                ", weight=" + weight +
                ", neutered=" + neutered +
                '}';
    }
}
