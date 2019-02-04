package pt.amsi.ipleiria.pet4all.Models;

import android.content.Context;
import android.util.Log;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.sql.Date;
import java.sql.Timestamp;
import java.text.Format;
import java.text.SimpleDateFormat;
import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Helpers.DateHelper;

public class Message {
    private long id;
    private String username;
    private String description;
    private int status;
    private long created_at;


    public Message() {}

    public Message(long id, String username, String description, int status, long created_at) {
        this.id = id;
        this.username = username;
        this.description = description;
        this.status = status;
        this.created_at = created_at;
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getUsername() {
        return this.username;
    }

    public void setUsername(String username) {
        this.username = username;
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

    public long getCreated_at() {
        return created_at;
    }

    public void setCreated_at(long created_at) {
        this.created_at = created_at;
    }

    public static ArrayList<Message> parseJSONMessages(JSONArray arrResponse, Context context){
        ArrayList<Message> tempArrListMessages = new ArrayList<>();

        try {
            for (int i = 0; i < arrResponse.length(); i++){
                String strAdoption = arrResponse.get(i).toString();
                Message tempAdoption = Message.parseJSONMessage(strAdoption, context);

                if(tempAdoption == null) continue;

                tempArrListMessages.add(tempAdoption);
            }
        }catch (JSONException ex){
            Toast.makeText(context, "Error:" + ex.getMessage(), Toast.LENGTH_SHORT).show();
        }

        return tempArrListMessages;
    }

    public static Message parseJSONMessage(String strResponse, Context context) {
        Message tempMessage = null;

        /* Try Convert Response To Adoption */
        try{
            JSONObject jobjMessage = new JSONObject(strResponse);

            long id = 0;
            String username = "",description = "";
            int status = -1;
            long created_at = 0;

            id = jobjMessage.getLong("id");
            username = jobjMessage.getString("username");
            created_at = jobjMessage.getLong("created_at");
            description = jobjMessage.getString("message");
            status = jobjMessage.getInt("status");

            tempMessage = new Message(
                    id,
                    username,
                    description,
                    status,
                    created_at
            );

        }catch(JSONException ex){
            ex.printStackTrace();
            Log.e("PARSE_JSON_MESSAGE", ex.toString());
        }

        return tempMessage;
    }

    @Override
    public String toString() {
        return "Message{" +
                "id=" + id +
                ", username='" + username + '\'' +
                ", description='" + description + '\'' +
                ", status=" + status +
                ", created_at=" + created_at +
                '}';
    }
}
