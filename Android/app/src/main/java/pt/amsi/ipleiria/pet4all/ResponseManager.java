package pt.amsi.ipleiria.pet4all;


public interface ResponseManager {
    public void onResponse(Object response);
    public void onError(String message);
}
