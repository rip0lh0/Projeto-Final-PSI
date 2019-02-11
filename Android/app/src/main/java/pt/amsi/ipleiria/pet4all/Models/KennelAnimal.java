package pt.amsi.ipleiria.pet4all.Models;

import android.content.Context;
import android.util.Log;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class KennelAnimal {
    public long id;
    public Kennel kennel;
    public Animal animal;
    private long created_at, updated_at;
    private int status;

    public KennelAnimal() {}

    public KennelAnimal(long id, Kennel kennel, Animal animal, long created_at, long updated_at, int status) {
        this.id = id;
        this.kennel = kennel;
        this.animal = animal;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.status = status;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public Kennel getKennel() {
        return kennel;
    }

    public void setKennel(Kennel kennel) {
        this.kennel = kennel;
    }

    public Animal getAnimal() {
        return animal;
    }

    public void setAnimal(Animal animal) {
        this.animal = animal;
    }

    public long getCreated_at() {
        return created_at;
    }

    public void setCreated_at(long created_at) {
        this.created_at = created_at;
    }

    public long getUpdated_at() {
        return updated_at;
    }

    public void setUpdated_at(long updated_at) {
        this.updated_at = updated_at;
    }

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }

    @Override
    public String toString() {
        return "KennelAnimal{" +
                "id=" + id +
                ", kennel=" + kennel +
                ", animal=" + animal +
                ", created_at=" + created_at +
                ", updated_at=" + updated_at +
                ", status=" + status +
                '}';
    }

    public static ArrayList<KennelAnimal> parseJSONKennelAnimals(JSONArray arrResponse, Context context){
        ArrayList<KennelAnimal> tempArrListsKennelAnimals = new ArrayList<>();

        try {
            for (int i = 0; i < arrResponse.length(); i++){
                String strResponse = arrResponse.get(i).toString();
                KennelAnimal tempKennelAnimal = KennelAnimal.parseJSONKennelAnimal(strResponse, context);
                if(tempKennelAnimal == null) continue;

                tempArrListsKennelAnimals.add(tempKennelAnimal);
            }
        }catch (JSONException ex){
            Toast.makeText(context, "Error:" + ex.getMessage(), Toast.LENGTH_SHORT).show();
        }

        return tempArrListsKennelAnimals;
    }

    public static KennelAnimal parseJSONKennelAnimal(String strResponse, Context context){
        KennelAnimal tempKennelAnimal = null;

        try {
            JSONObject jsonObject = new JSONObject(strResponse);

            long id;
            Kennel kennel;
            Animal animal;
            long created_at, updated_at;
            int status;

            id = jsonObject.getLong("id");
            String strKennel = jsonObject.getString("kennel");
            kennel = Kennel.parseJSONKennel(strKennel, context);
            String strAnimal = jsonObject.getString("animal");
            animal = Animal.parserJsonAnimal(strAnimal, context);

            created_at = jsonObject.getLong("created_at");
            updated_at = jsonObject.getLong("updated_at");

            status = jsonObject.getInt("status");

            tempKennelAnimal = new KennelAnimal(
                    id,
                    kennel,
                    animal,
                    created_at,
                    updated_at,
                    status
            );
            Log.e("KENNELANIMAL", tempKennelAnimal.toString());
        } catch (JSONException e) {
            e.printStackTrace();
        }

        return tempKennelAnimal;
    }



}
