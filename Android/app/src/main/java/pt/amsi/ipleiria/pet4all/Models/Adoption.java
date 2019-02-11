package pt.amsi.ipleiria.pet4all.Models;

import android.content.Context;
import android.util.Log;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class Adoption {
    private long id;
    private long id_adopter;
    private KennelAnimal kennelAnimal;
    private long created_at;
    private long updated_at;
    private String description;
    private ArrayList<Message> arrListMessages;
    private int status;

    public Adoption() {}

    public Adoption(long id, long id_adopter, KennelAnimal kennelAnimal, long created_at, long updated_at, String description, int status) {
        this.id = id;
        this.id_adopter = id_adopter;
        this.kennelAnimal = kennelAnimal;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.description = description;
        this.status = status;
    }

    public Adoption(long id, long id_adopter, KennelAnimal kennelAnimal, long created_at, long updated_at, String description, ArrayList<Message> arrListMessages, int status) {
        this.id = id;
        this.id_adopter = id_adopter;
        this.kennelAnimal = kennelAnimal;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.description = description;
        this.arrListMessages = arrListMessages;
        this.status = status;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public long getId_adopter() {
        return id_adopter;
    }

    public void setId_adopter(long id_adopter) {
        this.id_adopter = id_adopter;
    }

    public KennelAnimal getKennelAnimal() {
        return kennelAnimal;
    }

    public void setKennelAnimal(KennelAnimal kennelAnimal) {
        this.kennelAnimal = kennelAnimal;
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

    public ArrayList<Message> getArrListMessages() {
        return arrListMessages;
    }

    public void setArrListMessages(ArrayList<Message> arrListMessages) {
        this.arrListMessages = arrListMessages;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }

    public static ArrayList<Adoption> parseJSONAdoptions(JSONArray arrResponse, Context context){
        ArrayList<Adoption> tempArrListAdoptions = new ArrayList<>();

        try {
            for (int i = 0; i < arrResponse.length(); i++){
                String strResponse = arrResponse.get(i).toString();
                Adoption tempAdoption = Adoption.parseJSONAdoption(strResponse, context);

                if(tempAdoption == null) continue;

                tempArrListAdoptions.add(tempAdoption);
            }
        }catch (JSONException ex){
            Toast.makeText(context, "Error:" + ex.getMessage(), Toast.LENGTH_SHORT).show();
        }

        return tempArrListAdoptions;
    }

    public static Adoption parseJSONAdoption(String response, Context context){
        Adoption tempAdoption = null;

        /* Try Convert Response To Adoption */
        try{
            JSONObject jobjAdoption = new JSONObject(response);

            long id  = 0, id_adopter = 0;
            KennelAnimal kennelAnimal = null;
            long created_at = 0, updated_at = 0;
            String description = "";
            ArrayList<Message> arrListMessages = null;
            int status = -1;

            id = jobjAdoption.getLong("id");
            id_adopter = jobjAdoption.getLong("id_adopter");

            String strKennelAnimal = jobjAdoption.getString("kennelAnimal");
            kennelAnimal = KennelAnimal.parseJSONKennelAnimal(strKennelAnimal, context);

            created_at = jobjAdoption.getLong("created_at");
            updated_at = jobjAdoption.getLong("updated_at");

            try {
                description = jobjAdoption.getString("description");
            }catch (JSONException e){
                e.printStackTrace();
                Log.e("PARSE_JSON_ERROR", e.toString());
            }

            JSONArray arrMessages = jobjAdoption.getJSONArray("messages");
            if(arrMessages.length() != 0) arrListMessages = Message.parseJSONMessages(arrMessages, context);

            status = jobjAdoption.getInt("status");

            tempAdoption = new Adoption(
                    id,
                    id_adopter,
                    kennelAnimal,
                    created_at,
                    updated_at,
                    description,
                    arrListMessages,
                    status
            );
        }catch(JSONException e){
            e.printStackTrace();
            Log.e("PARSE_JSON_ERROR", e.toString());

        }


        return tempAdoption;
    }


}
