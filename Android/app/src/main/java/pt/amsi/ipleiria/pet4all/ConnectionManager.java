package pt.amsi.ipleiria.pet4all;

import android.content.Context;
import android.util.Base64;
import android.util.Log;

import com.android.volley.AuthFailureError;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class ConnectionManager{
    private static ConnectionManager instance = null;
    protected static final String PREFIX_URL ="http://192.168.1.198/v1/";

    public RequestQueue requestQueue;

    public ConnectionManager(Context context){
        requestQueue = Volley.newRequestQueue(context);
    }

    public static synchronized ConnectionManager getInstance(Context context) {
        if (null == instance) instance = new ConnectionManager(context);
        return instance;
    }

    public static synchronized ConnectionManager getInstance()
    {
        if (null == instance) throw new IllegalStateException(ConnectionManager.class.getSimpleName() +" is not initialized");
        return instance;
    }

    public void makeRequest(int method, String url, final ResponseManager responseManager){
        String final_url = PREFIX_URL + url;

        StringRequest strRequest = new StringRequest(method, final_url, new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                try {
                    JSONArray array = new JSONArray(response);
                    responseManager.onResponse(new JSONArray(response));
                } catch (JSONException e) {
                    responseManager.onError(e.toString());
                }
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error) {
                responseManager.onError(error.toString());
            }
        });

        requestQueue.add(strRequest);
    }

    public void authRequest(int method, String url, final String username, final String password, JSONObject params, final ResponseManager responseManager){
        String final_url = PREFIX_URL + url;

        Log.v("AUTH_REQUEST", "FINAL_URL: \n" + final_url);

        JsonObjectRequest strRequest = new JsonObjectRequest(method, final_url, params, new Response.Listener<JSONObject>(){
            @Override
            public void onResponse(JSONObject response) {
                Log.e("CONNECTION_MANAGER_AUTH", "ON_RESPONSE: \n " + response.toString());
                responseManager.onResponse(response);
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e("CONNECTION_MANAGER_AUTH", "ERROR_RESPONSE: \n" + error.toString());
                responseManager.onError(error.toString());
            }
        }){
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();

                String credentials = String.format("%s:%s", username, password);

                String auth = "Basic " + Base64.encodeToString(credentials.getBytes(), Base64.NO_WRAP);
                headers.put("Content-Type", "application/x-www-form-urlencoded");
                headers.put("Authorization", auth);
                Log.e("MAP_HEADERS", "HEADERS: " + headers.toString());
                return headers;
            }
        };

        requestQueue.add(strRequest);
    }

}
