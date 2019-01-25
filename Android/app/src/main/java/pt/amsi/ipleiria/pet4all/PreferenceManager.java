package pt.amsi.ipleiria.pet4all;

import android.content.Context;
import android.content.SharedPreferences;

public class PreferenceManager {
    //private static String KEY_CREDENTIALS = "keycredentials";

    public void setPreferences(String key, String value, Context context, int mode){
        SharedPreferences sharedPref = context.getSharedPreferences(key, mode);

        SharedPreferences.Editor editor = sharedPref.edit();
        editor.putString(key, value);

        editor.apply();
    }

    public String getPreferences(String key, Context context, int mode){
        SharedPreferences sharedPref = context.getSharedPreferences(key, mode);
        String value = sharedPref.getString(key, "");

        return value;
    }
}
