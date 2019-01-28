package pt.amsi.ipleiria.pet4all;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.util.Base64;
import android.util.Log;

import com.android.volley.AuthFailureError;
import com.android.volley.NetworkError;
import com.android.volley.NoConnectionError;
import com.android.volley.ParseError;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.ServerError;
import com.android.volley.TimeoutError;
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

    public static synchronized ConnectionManager getInstance() {
        if (null == instance) throw new IllegalStateException(ConnectionManager.class.getSimpleName() +" is not initialized");
        return instance;
    }

    public static boolean checkInternetConnection(Context context){
        ConnectivityManager cm = (ConnectivityManager)context.getSystemService(Context.CONNECTIVITY_SERVICE);

        NetworkInfo networkInfo = cm.getActiveNetworkInfo();

        return networkInfo != null && networkInfo.isConnected();
    }

    public void makeRequest(int method, String url, final Map<String, String> params, final ResponseManager responseManager){
        String final_url = PREFIX_URL + url;

        StringRequest strRequest = new StringRequest(method, final_url, new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject obj = new JSONObject(response);
                    if(obj.has("error"))responseManager.onError(obj.getString("error"));
                    else responseManager.onResponse(obj);
                } catch (JSONException e) {
                    responseManager.onError(e.toString());
                }
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error) {
                responseManager.onError(error.toString());
            }
        }){
            @Override
            protected Map<String, String> getParams(){return params;}
        };

        requestQueue.add(strRequest);
    }

    public void authRequest(int method, String url, final String username, final String password, JSONObject params, final ResponseManager responseManager){
        String final_url = PREFIX_URL + url;

        JsonObjectRequest strRequest = new JsonObjectRequest(method, final_url, params, new Response.Listener<JSONObject>(){
            @Override
            public void onResponse(JSONObject response) {
                Log.e("CONNECTION_MANAGER_AUTH", "ON_RESPONSE: \n " + response.toString());
                responseManager.onResponse(response);
            }
        }, new Response.ErrorListener(){
            @Override
            public void onErrorResponse(VolleyError error) {
                if (error instanceof TimeoutError) {

                } else if(error instanceof NoConnectionError){

                } else if (error instanceof AuthFailureError) {
                    //TODO
                } else if (error instanceof ServerError) {
                    //TODO
                } else if (error instanceof NetworkError) {
                    //TODO
                } else if (error instanceof ParseError) {
                    //TODO
                }


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
