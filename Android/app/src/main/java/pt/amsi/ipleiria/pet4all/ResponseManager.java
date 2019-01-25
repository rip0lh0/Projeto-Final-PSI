package pt.amsi.ipleiria.pet4all;


import org.json.JSONObject;

public interface ResponseManager {
    public void onResponse(JSONObject response);
    public void onError(String message);
}
