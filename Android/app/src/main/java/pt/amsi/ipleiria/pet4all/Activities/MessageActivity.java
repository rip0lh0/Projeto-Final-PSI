package pt.amsi.ipleiria.pet4all.Activities;

import android.app.ActivityOptions;
import android.content.Context;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;

import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.PreferenceManager;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.ResponseManager;

public class MessageActivity extends AppCompatActivity {

    private TextView message;
    private Button btnSendMsg;
    private TextView MsgDisplay;
    private String animal_created_at;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_message);

        message = findViewById(R.id.edtMessage);
        btnSendMsg = findViewById(R.id.btnSendMessage);
        //MsgDisplay = findViewById(R.id.txtMsgDisplay);
        animal_created_at = getIntent().getStringExtra("created_at");

        Log.e("MESSAGE", animal_created_at);


        btnSendMsg.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                publishMessage();
            }
        });

    }

    public void publishMessage(){
        Map<String, String> userParams = new HashMap<String, String>();
        String username = "";

        username = PreferenceManager.getPreferences("KEYCREDENTIALS", MessageActivity.this, Context.MODE_PRIVATE);

        userParams.put("username", username);
        userParams.put("created_at", animal_created_at);
        userParams.put("message", message.getText().toString());

        ConnectionManager connection = new ConnectionManager(MessageActivity.this);
        connection.makeRequest(Request.Method.POST, "animal/publish-message", userParams, new ResponseManager() {
            @Override
            public void onResponse(JSONObject response) {
                if(response.has("success")){
                    Toast.makeText(MessageActivity.this, "Enviado", Toast.LENGTH_LONG).show();
                    finish();
                }else{
                    Toast.makeText(MessageActivity.this, "Error Sending Message", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onError(String message) {
                Toast.makeText(MessageActivity.this, "Error Sending Message", Toast.LENGTH_LONG).show();
            }
        });
    }

}
