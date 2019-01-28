package pt.amsi.ipleiria.pet4all.Activities;

import android.app.ActivityOptions;
import android.content.Context;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;

import com.android.volley.Request;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.PreferenceManager;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.ResponseManager;

public class ProfileActivity extends AppCompatActivity {

    private TextView tvUsername;
    private TextView tvName;
    private TextView tvCreated_at;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        tvName = findViewById(R.id.profile_full_name);
        tvUsername = findViewById(R.id.profile_name);
        tvCreated_at = findViewById(R.id.profile_created_at);

        if(!PreferenceManager.hasKey("KEYCREDENTIALS", ProfileActivity.this, Context.MODE_PRIVATE)){
            Intent intent = new Intent(ProfileActivity.this, LoginActivity.class);

            ActivityOptions options = ActivityOptions.makeCustomAnimation(ProfileActivity.this,android.R.anim.fade_in,android.R.anim.fade_out);
            startActivity(intent, options.toBundle());
            finish();
        }

        String username = PreferenceManager.getPreferences("KEYCREDENTIALS", this, Context.MODE_PRIVATE);

        Log.e("PROFILE", username);


        ConnectionManager connectionMng = new ConnectionManager(this);
        connectionMng.makeRequest(Request.Method.GET, "user/profile?username="+username, null, new ResponseManager() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    JSONObject arrUser = response.getJSONObject("success");

                    tvUsername.setText(arrUser.getString("username"));
                    tvName.setText("Nome: " + arrUser.getString("name"));
                    tvCreated_at.setText("Criado a: "+ arrUser.getString("created_at"));


                } catch (JSONException e) {
                    Intent intent = new Intent(ProfileActivity.this, AnimalsActivity.class);

                    ActivityOptions options = ActivityOptions.makeCustomAnimation(ProfileActivity.this,android.R.anim.fade_in,android.R.anim.fade_out);
                    startActivity(intent, options.toBundle());
                    finish();
                }
            }

            @Override
            public void onError(String message) {
                Log.e("PROFILE", message.toString());

            }
        });

    }

    public void logout(View view) {
        ImageButton btnSignout;

        PreferenceManager.removePreferences("KEYCREDENTIALS", ProfileActivity.this, Context.MODE_PRIVATE);

        Intent intent= new Intent(ProfileActivity.this, AnimalsActivity.class);

        ActivityOptions options = ActivityOptions.makeCustomAnimation(ProfileActivity.this,android.R.anim.fade_in,android.R.anim.fade_out);
        startActivity(intent, options.toBundle());

    }
}
