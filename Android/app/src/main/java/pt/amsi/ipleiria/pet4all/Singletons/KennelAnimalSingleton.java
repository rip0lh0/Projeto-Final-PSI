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
import pt.amsi.ipleiria.pet4all.Interfaces.ListListener;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.Models.Kennel;
import pt.amsi.ipleiria.pet4all.Models.KennelAnimal;
import pt.amsi.ipleiria.pet4all.Models.Message;
import pt.amsi.ipleiria.pet4all.ResponseManager;

public class KennelAnimalSingleton implements ListListener<KennelAnimal>{
    private static KennelAnimalSingleton INSTANCE = null;

    private final String URL = "animal/";

    private ArrayList<KennelAnimal> arrListKennelAnimals;
    private static ConnectionManager connectionMng = null;
    private ListListener<KennelAnimal> listListener = null;
    private ListListener<Message> listListenerMessage = null;

    public KennelAnimalSingleton(Context context){
        this.arrListKennelAnimals = new ArrayList<>();
        /* TODO Database Connection */
    }

    public static synchronized KennelAnimalSingleton getInstance(Context context){
        if(INSTANCE == null){
            connectionMng = new ConnectionManager(context);
            INSTANCE = new KennelAnimalSingleton(context);
        }
        return INSTANCE;
    }

    public void setListListener(ListListener<KennelAnimal> kennelAnimalListListener){
        this.listListener = kennelAnimalListListener;
    }

    public Kennel getKennel(long id_kennel){
        for (KennelAnimal kennelAnimal : arrListKennelAnimals) {
            if(kennelAnimal.getKennel().getId() == id_kennel) return kennelAnimal.getKennel();
        }
        return null;
    }

    public Animal getAnimal(long id_animal){
        for (KennelAnimal kennelAnimal : arrListKennelAnimals) {
            if(kennelAnimal.getAnimal().getId() == id_animal) return kennelAnimal.getAnimal();
        }
        return null;
    }

    public KennelAnimal getKennelAnimal(long id_kennelAnimal){
        for (KennelAnimal kennelAnimal : arrListKennelAnimals) {
            if(kennelAnimal.getId() == id_kennelAnimal) return kennelAnimal;
        }
        return null;
    }

    public void getKennelAnimals(final Context context){
        /* IF NO INTERNET CONNECTION*/
        if(!ConnectionManager.checkInternetConnection(context)){
            Toast.makeText(context, "No Connection", Toast.LENGTH_SHORT);
            return;
        }

        connectionMng.makeRequest(Request.Method.GET, this.URL, null, new ResponseManager() {
            @Override
            public void onResponse(JSONObject response) {
                Log.e("KENNELANIMALS_RESPONSE", response.toString());
                try {
                    JSONArray arrKennelAnimals = response.getJSONArray("success");

                    arrListKennelAnimals = KennelAnimal.parseJSONKennelAnimals(arrKennelAnimals, context);

                    if (listListener != null)
                        listListener.onRefreshList(arrListKennelAnimals);
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }

            @Override
            public void onError(String message) {
                Log.e("KENNELANIMALS_ERROR", message);
            }
        });

    }

    @Override
    public void onRefreshList(ArrayList<KennelAnimal> list) {

    }

    @Override
    public void onUpdateList(KennelAnimal item, int operacao) {

    }
}
