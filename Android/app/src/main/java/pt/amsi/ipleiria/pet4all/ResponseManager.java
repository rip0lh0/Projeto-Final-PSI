package pt.amsi.ipleiria.pet4all;


import org.json.JSONArray;
import org.json.JSONObject;

public interface ResponseManager {
    public void onResponse(JSONArray response);
    public void onAuthResponse(JSONObject response);
    public void onError(String message);
}
