package pt.amsi.ipleiria.pet4all.Activities;

import android.app.ActivityOptions;
import android.content.Context;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;

import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

import pt.amsi.ipleiria.pet4all.Adapters.MessageListAdapter;
import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.Interfaces.ListListener;
import pt.amsi.ipleiria.pet4all.Models.Adoption;
import pt.amsi.ipleiria.pet4all.Models.KennelAnimal;
import pt.amsi.ipleiria.pet4all.Models.Message;
import pt.amsi.ipleiria.pet4all.PreferenceManager;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.ResponseManager;
import pt.amsi.ipleiria.pet4all.Singletons.AdoptionSingleton;
import pt.amsi.ipleiria.pet4all.Singletons.KennelAnimalSingleton;

public class MessageActivity extends AppCompatActivity implements ListListener<Message> {

    private EditText message;
    private Button btnSendMsg;
    private TextView MsgDisplay;

    private KennelAnimal kennelAnimal;
    private Adoption adoption;
    private String username;

    private ArrayList<Message> arrListMessages;
    ListView listView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_message);

        message = findViewById(R.id.edtMessage);
        btnSendMsg = findViewById(R.id.btnSendMessage);
        listView = findViewById(R.id.listview_messages);

        long id_kennelAnimal = Long.parseLong(getIntent().getStringExtra("IDKENNELANIMAL"));

        kennelAnimal = KennelAnimalSingleton.getInstance(getApplicationContext()).getKennelAnimal(id_kennelAnimal);

        if(kennelAnimal != null){
            Adoption ad = AdoptionSingleton.getInstance(getApplicationContext()).getAdoptionByKennelAnimal(id_kennelAnimal);
            if(ad != null) reloadListView();
        }

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
        userParams.put("message", message.getText().toString());

        ConnectionManager connection = new ConnectionManager(MessageActivity.this);
        connection.makeRequest(Request.Method.POST, "animal/publish-message?id_kennelAnimal=" + kennelAnimal.getId(), userParams, new ResponseManager() {
            @Override
            public void onResponse(JSONObject response) {
                if(response.has("success")){
                    Toast.makeText(MessageActivity.this, "Enviado", Toast.LENGTH_LONG).show();

                    Intent intent = new Intent(MessageActivity.this, AdoptionsActivity.class);
                    ActivityOptions options = ActivityOptions.makeCustomAnimation(MessageActivity.this, android.R.anim.fade_in, android.R.anim.fade_out);
                    startActivity(intent, options.toBundle());
                    finish();
                }else{
                    Toast.makeText(MessageActivity.this, "Error Sending Message", Toast.LENGTH_LONG).show();
                }
            }

            @Override
            public void onError(String message) {
                Log.e("MESSAGE_RESPONSE_ERROR", message);
                Toast.makeText(MessageActivity.this, "Error Sending Message", Toast.LENGTH_LONG).show();
            }
        });
    }

    public void reloadListView(){
        adoption = AdoptionSingleton.getInstance(getApplicationContext()).getAdoptionByKennelAnimal(kennelAnimal.getId());

        AdoptionSingleton.getInstance(getApplicationContext()).setListListenerMessage(this);
        AdoptionSingleton.getInstance(getApplicationContext()).getMessage(adoption.getId());
    }

    @Override
    public void onRefreshList(ArrayList<Message> list) {
        if(!list.isEmpty()){
            MessageListAdapter messageListAdapter = new MessageListAdapter(this, list);
            listView.setAdapter(messageListAdapter);

            messageListAdapter.refresh(list);
        }
    }

    @Override
    public void onUpdateList(Message item, int operacao) {

    }

}
