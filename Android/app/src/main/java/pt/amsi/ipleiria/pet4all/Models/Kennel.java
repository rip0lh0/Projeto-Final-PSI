package pt.amsi.ipleiria.pet4all.Models;

import android.content.Context;
import android.util.Log;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class Kennel {
    private long id;
    private long id_user;
    private String name, nif, address, local;
    private int phone, cellPhone;
    private String social_facebook, social_instagram, social_youtube;

    public Kennel() {}

    public Kennel(long id, long id_user, String name, String nif, String address, String local, int phone, int cellPhone, String social_facebook, String social_instagram, String social_youtube) {
        this.id = id;
        this.id_user = id_user;
        this.name = name;
        this.nif = nif;
        this.address = address;
        this.local = local;
        this.phone = phone;
        this.cellPhone = cellPhone;
        this.social_facebook = social_facebook;
        this.social_instagram = social_instagram;
        this.social_youtube = social_youtube;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public long getId_user() {
        return id_user;
    }

    public void setId_user(long id_user) {
        this.id_user = id_user;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getNif() {
        return nif;
    }

    public void setNif(String nif) {
        this.nif = nif;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getLocal() {
        return local;
    }

    public void setLocal(String local) {
        this.local = local;
    }

    public int getPhone() {
        return phone;
    }

    public void setPhone(int phone) {
        this.phone = phone;
    }

    public int getCellPhone() {
        return cellPhone;
    }

    public void setCellPhone(int cellPhone) {
        this.cellPhone = cellPhone;
    }

    public String getSocial_facebook() {
        return social_facebook;
    }

    public void setSocial_facebook(String social_facebook) {
        this.social_facebook = social_facebook;
    }

    public String getSocial_instagram() {
        return social_instagram;
    }

    public void setSocial_instagram(String social_instagram) {
        this.social_instagram = social_instagram;
    }

    public String getSocial_youtube() {
        return social_youtube;
    }

    public void setSocial_youtube(String social_youtube) {
        this.social_youtube = social_youtube;
    }

    @Override
    public String toString() {
        return "Kennel{" +
                "id=" + id +
                ", id_user=" + id_user +
                ", name='" + name + '\'' +
                ", nif='" + nif + '\'' +
                ", address='" + address + '\'' +
                ", local='" + local + '\'' +
                ", phone=" + phone +
                ", cellPhone=" + cellPhone +
                ", social_facebook='" + social_facebook + '\'' +
                ", social_instagram='" + social_instagram + '\'' +
                ", social_youtube='" + social_youtube + '\'' +
                '}';
    }

    public static ArrayList<Kennel> parseJSONKennels(JSONArray arrResponse, Context context){
        ArrayList<Kennel> tempArrListKennels = new ArrayList<>();

        try {
            for (int i = 0; i < arrResponse.length(); i++){
                String strResponse = arrResponse.get(i).toString();
                Kennel tempKennel = Kennel.parseJSONKennel(strResponse, context);
                if(tempKennel == null) continue;

                tempArrListKennels.add(tempKennel);
            }
        }catch (JSONException ex){
            Toast.makeText(context, "Error:" + ex.getMessage(), Toast.LENGTH_SHORT).show();
        }

        return tempArrListKennels;
    }

    public static Kennel parseJSONKennel(String strResponse, Context context){
        Kennel tempKennel = null;

        try {
            JSONObject jsonObject = new JSONObject(strResponse);

            long id = 0;
            long id_user = 0;
            String name = "", nif = "", address = "", local = "";
            int phone = 0, cellPhone = 0;
            String social_facebook = "", social_instagram = "", social_youtube = "";

            id = jsonObject.getLong("id");
            id_user = jsonObject.getLong("id_user");

            name = jsonObject.getString("name");
            nif = jsonObject.getString("nif");
            address = jsonObject.getString("address");
            local = jsonObject.getString("local");
            social_facebook = jsonObject.getString("facebook");
            social_instagram = jsonObject.getString("instagram");
            social_youtube = jsonObject.getString("youtube");

            try {
                phone = jsonObject.getInt("phone");
            }catch (JSONException e){
                Log.e("JSON_KENNEL_PHONE", e.toString());
            }

            try {
                cellPhone = jsonObject.getInt("cell_phone");
            }catch (JSONException e){
                Log.e("JSON_KENNEL_PHONE", e.toString());
            }


            tempKennel = new Kennel(
                    id,
                    id_user,
                    name,
                    nif,
                    address,
                    local,
                    phone,
                    cellPhone,
                    social_facebook,
                    social_instagram,
                    social_youtube
            );
        } catch (JSONException e) {
            e.printStackTrace();
            Log.e("JSON_KENNEL", e.toString());
        }

        return tempKennel;
    }


}
