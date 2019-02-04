package pt.amsi.ipleiria.pet4all.Activities;

import android.app.ActivityOptions;
import android.content.Context;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.DisplayMetrics;
import android.util.Log;
import android.util.TypedValue;
import android.view.View;
import android.view.ViewTreeObserver;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.PreferenceManager;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.ResponseManager;

public class ProfileActivity extends AppCompatActivity {

    private boolean editText_state;
    private ProgressBar progressBarProfile;

    private TextView textViewUsername;
    private TextView textViewCreated_at;

    private TextView textViewName;
    private TextView textViewEmail;
    private TextView textViewPhone;

    private EditText editTextName;
    private EditText editTextEmail;
    private EditText editTextPhone;

    private Button btnEdit;
    private Button btnLogout;

    View activityRootView = null;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        progressBarProfile = findViewById(R.id.profile_progress_bar);
        textViewUsername = findViewById(R.id.profile_username);
        textViewCreated_at = findViewById(R.id.profile_created_at);

        textViewName = findViewById(R.id.tf_profile_name);
        textViewEmail = findViewById(R.id.tf_profile_email);
        textViewPhone = findViewById(R.id.tf_profile_phone);
        editTextName = findViewById(R.id.et_profile_name);
        editTextEmail = findViewById(R.id.et_profile_email);
        editTextPhone = findViewById(R.id.et_profile_phone);

        btnEdit = findViewById(R.id.btn_edit);
        btnLogout = findViewById(R.id.btn_logout);
        editText_state = true;

        activityRootView = findViewById(R.id.main_view);

        activityRootView.getViewTreeObserver().addOnGlobalLayoutListener(new ViewTreeObserver.OnGlobalLayoutListener() {
            @Override
            public void onGlobalLayout() {
                int heightDiff = activityRootView.getRootView().getHeight() - activityRootView.getHeight();
                if (heightDiff > dpToPx(getApplicationContext(), 200)) {
                    btnLogout.setVisibility(View.GONE);
                }else{
                    btnLogout.setVisibility(View.VISIBLE);
                }
            }
        });

        loadData();
        btnEdit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                toogleFields(editText_state);
            }
        });
    }

    public void loadData(){
        progressBarProfile.setVisibility(View.VISIBLE);
        String username = PreferenceManager.getPreferences("KEYCREDENTIALS", this, Context.MODE_PRIVATE);

        String url = "user/profile?username="+username;
        Log.e("LOAD_DATA", url);
        ConnectionManager connectionMng = new ConnectionManager(this);
        connectionMng.makeRequest(Request.Method.GET, url, null, new ResponseManager() {
            @Override
            public void onResponse(JSONObject response) {
                try {
                    JSONObject arrUser = response.getJSONObject("success");

                    String phoneNumber =arrUser.getString("cellphone");

                    textViewUsername.setText(arrUser.getString("username"));
                    textViewCreated_at.setText("Membro desde: " + arrUser.getString("created_at"));

                    textViewName.setText(arrUser.getString("name"));
                    textViewEmail.setText(arrUser.getString("email"));
                    textViewPhone.setText(phoneNumber);

                    editTextEmail.setText(arrUser.getString("email"));
                    editTextName.setText(arrUser.getString("name"));
                    editTextPhone.setText(phoneNumber);

                    progressBarProfile.setVisibility(View.GONE);

                } catch (JSONException e) {
                    Intent intent = new Intent(ProfileActivity.this, AnimalsActivity.class);

                    ActivityOptions options = ActivityOptions.makeCustomAnimation(ProfileActivity.this,android.R.anim.fade_in,android.R.anim.fade_out);
                    startActivity(intent, options.toBundle());
                    finish();
                }
            }

            @Override
            public void onError(String message) {
                Intent intent = new Intent(ProfileActivity.this, AnimalsActivity.class);

                ActivityOptions options = ActivityOptions.makeCustomAnimation(ProfileActivity.this,android.R.anim.fade_in,android.R.anim.fade_out);
                startActivity(intent, options.toBundle());
                Toast.makeText(getApplicationContext(),message, Toast.LENGTH_LONG).show();
                finish();
            }
        });
    }

    public void toogleFields(final boolean state){
        if(state) {
            editTextName.setVisibility(View.VISIBLE);
            editTextEmail.setVisibility(View.VISIBLE);
            editTextPhone.setVisibility(View.VISIBLE);

            textViewName.setVisibility(View.GONE);
            textViewEmail.setVisibility(View.GONE);
            textViewPhone.setVisibility(View.GONE);
            btnEdit.setText(R.string.lb_save);
        }else{
            editTextName.setVisibility(View.GONE);
            editTextEmail.setVisibility(View.GONE);
            editTextPhone.setVisibility(View.GONE);

            textViewName.setVisibility(View.VISIBLE);
            textViewEmail.setVisibility(View.VISIBLE);
            textViewPhone.setVisibility(View.VISIBLE);
            btnEdit.setText(R.string.lb_edit);
            this.Save(state);
        }

        editText_state = !state;
    }

    public void Save(boolean state){
        if(state)return;
        try {
            Map<String, String> userParams = new HashMap<String, String>();

            String username = textViewUsername.getText().toString();

            userParams.put("name", editTextName.getText().toString());
            userParams.put("email", editTextEmail.getText().toString());
            userParams.put("phone", editTextPhone.getText().toString());

            String url = "user/change-profile?username="+ username;

            ConnectionManager connection = new ConnectionManager(ProfileActivity.this);
            connection.makeRequest(Request.Method.POST,  url, userParams, new ResponseManager() {
                @Override
                public void onResponse(JSONObject response) {
                    if(response.has("success")){
                        Toast.makeText(ProfileActivity.this, "Alterado Com successo", Toast.LENGTH_SHORT).show();

                        textViewPhone.setText(editTextPhone.getText());
                        textViewEmail.setText(editTextEmail.getText());
                        textViewName.setText(editTextName.getText());

                    }else{
                        editTextName.setError("name");
                        editTextEmail.setError("email");
                    }
                }

                @Override
                public void onError(String message) {
                    Toast.makeText(ProfileActivity.this, message, Toast.LENGTH_LONG).show();
                }
            });
            Thread.sleep(6000);
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
    }

    public static float dpToPx(Context context, float valueInDp) {
        DisplayMetrics metrics = context.getResources().getDisplayMetrics();
        return TypedValue.applyDimension(TypedValue.COMPLEX_UNIT_DIP, valueInDp, metrics);
    }

    public void logout(View view) {
        ImageButton btnSignout;

        PreferenceManager.removePreferences("KEYCREDENTIALS", ProfileActivity.this, Context.MODE_PRIVATE);

        Intent intent= new Intent(ProfileActivity.this, AnimalsActivity.class);

        ActivityOptions options = ActivityOptions.makeCustomAnimation(ProfileActivity.this,android.R.anim.fade_in,android.R.anim.fade_out);
        startActivity(intent, options.toBundle());

    }
}
