package pt.amsi.ipleiria.pet4all.Singletons;

import android.app.ActivityOptions;
import android.content.Context;
import android.content.Intent;
import android.util.Log;
import android.widget.Toast;

import com.android.volley.Request;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Activities.LoginActivity;
import pt.amsi.ipleiria.pet4all.Activities.ProfileActivity;
import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.Interfaces.ListListener;
import pt.amsi.ipleiria.pet4all.Models.Adoption;
import pt.amsi.ipleiria.pet4all.Models.KennelAnimal;
import pt.amsi.ipleiria.pet4all.Models.Message;
import pt.amsi.ipleiria.pet4all.PreferenceManager;
import pt.amsi.ipleiria.pet4all.ResponseManager;

public class AdoptionSingleton {
    public static AdoptionSingleton INSTANCE = null;

    private final String URL = "user/adoptions?username=";

    private static ConnectionManager connectionMng;
    private ListListener<Adoption> listListener = null;
    private ListListener<Message> listListenerMessage = null;
    private ArrayList<Adoption> arrListAdoption = null;

    public static synchronized AdoptionSingleton getInstance(Context context){
        if(INSTANCE == null){
            connectionMng = new ConnectionManager(context);
            INSTANCE = new AdoptionSingleton(context);
        }
        return INSTANCE;
    }

    private AdoptionSingleton(Context context){
        this.arrListAdoption = new ArrayList<Adoption>();
    }

    public Adoption getAdoption(long idAdoption){
        for (Adoption adoption: arrListAdoption) {
            if(adoption.getId() == idAdoption) return adoption;
        }
        return null;
    }

    public ArrayList<Message> getMessages(long idAdoption){
        for (Adoption adoption: arrListAdoption) {
            if(adoption.getId() == idAdoption) return adoption.getArrListMessages();
        }
        return null;
    }

    public void getMessage(long idAdoption){
        for (Adoption adoption: arrListAdoption) {
            if(adoption.getId() == idAdoption){
                if(listListenerMessage != null) listListenerMessage.onRefreshList(adoption.getArrListMessages());
            }
        }
    }

    public void getAdoptions(final Context context){
        if(!ConnectionManager.checkInternetConnection(context)) {
            Toast.makeText(context, "No Connection", Toast.LENGTH_LONG).show();
            return;
        }

        //if(!PreferenceManager.hasKey("KEYCREDENTIALS", context, Context.MODE_PRIVATE))
        String username = PreferenceManager.getPreferences("KEYCREDENTIALS", context, Context.MODE_PRIVATE);
        String final_URL = this.URL + username;

        Log.e("ADOPTIONS_GET", final_URL);

        /* Get Data */
        connectionMng.makeRequest(Request.Method.GET, final_URL, null, new ResponseManager() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    JSONArray arrAdoptions = response.getJSONArray("success");
                    Log.e("RESPONSE", response.toString());

                    arrListAdoption = Adoption.parseJSONAdoptions(arrAdoptions, context);

                    //Log.e("RESPONSE", arrListAdoption.toString());

                    if(listListener != null) listListener.onRefreshList(arrListAdoption);
                } catch (JSONException e) {
                    Log.e("ADOPTIONS_JSON_ERROR", e.toString());
                    Toast.makeText(context, "Data Error", Toast.LENGTH_SHORT);
                }
            }

            @Override
            public void onError(String message) {
                Log.e("ADOPTIONS_GET_ERROR", message);
            }
        });

    }

    public KennelAnimal getKennelAnimal(long idKennelAnimal){
        for (Adoption adoption: arrListAdoption) {
            if(adoption.getKennelAnimal().getId() == idKennelAnimal){
                return adoption.getKennelAnimal();
            }
        }

        return null;
    }

    public Adoption getAdoptionByKennelAnimal(long idKennelAnimal){
        for (Adoption adoption: arrListAdoption) {
            if(adoption.getKennelAnimal().getId() == idKennelAnimal){
                return adoption;
            }
        }

        return null;
    }

    public void setListListener(ListListener<Adoption> adoptionListListener){
        this.listListener = adoptionListListener;
    }

    public void setListListenerMessage(ListListener<Message> messageListListener){
        this.listListenerMessage = messageListListener;
    }

}
