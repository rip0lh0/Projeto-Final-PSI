package pt.amsi.ipleiria.pet4all;

import android.os.Bundle;
import android.os.Handler;
import android.support.design.widget.TextInputEditText;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import org.eclipse.paho.client.mqttv3.IMqttDeliveryToken;
import org.eclipse.paho.client.mqttv3.MqttCallback;
import org.eclipse.paho.client.mqttv3.MqttClient;
import org.eclipse.paho.client.mqttv3.MqttException;
import org.eclipse.paho.client.mqttv3.MqttMessage;

public class MainActivity extends AppCompatActivity {
    private Button btnConnect, btnSubscribe, btnUnsubscribe;
    private TextInputEditText textInputClient, textInputChannel;
    private TextView textMessages;
    private String apiMessages;

    private APIRest api;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        textInputClient = findViewById(R.id.text_input_client);
        textInputChannel = findViewById(R.id.text_input_channel);

        btnConnect = findViewById(R.id.btn_connect_server);
        btnSubscribe = findViewById(R.id.btn_subscribe);
        btnUnsubscribe = findViewById(R.id.btn_unsubscribe);

        textMessages = findViewById(R.id.text_received_messages);

        api = new APIRest(ServerProperties.SERVER, ServerProperties.PORT);

        this.ConfigListeners();
    }

    public void ConfigListeners(){
        btnConnect.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(final View view) {
                Connect();
            }
        });

        btnSubscribe.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Subscribe();
            }
        });

        btnUnsubscribe.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Unsubscribe();
            }
        });
    }

    public void Connect(){
        String clientId = "" + this.textInputClient.getText();

        if(clientId.equals(""))return;

        this.api.setClientID(clientId);

        try{
            this.api.Connect();

            this.api.mqttClient.setCallback(new MqttCallback() {
                @Override
                public void connectionLost(Throwable throwable) {
                    apiMessages = throwable.toString() + "\n" + apiMessages;
                    UpdateView();
                }

                @Override
                public void messageArrived(String s, MqttMessage mqttMessage) throws Exception {
                    String msg = new String(mqttMessage.getPayload());

                    if(msg.isEmpty()) return;

                    apiMessages = msg + "\n" + apiMessages;
                    Log.e("--> API", apiMessages);
                    runOnUiThread(new Runnable() {
                        public void run() {
                            //Toast.makeText(getApplicationContext(), apiMessages, Toast.LENGTH_SHORT).show();

                            UpdateView();
                        }
                    });
                }

                @Override
                public void deliveryComplete(IMqttDeliveryToken iMqttDeliveryToken) {
                    apiMessages = "Mensagem enviada" + "\n" + apiMessages;
                    UpdateView();
                }
            });

            this.apiMessages = "Connected to: " + ServerProperties.SERVER;
        } catch (MqttException ex) {
            this.apiMessages = "Faild To Connect";
        }
        UpdateView();
    }

    public void Subscribe(){
        String channel = "" + this.textInputChannel.getText();
        String result = "";
        if(channel.equals(""))return;

        this.apiMessages = this.api.Subscribe(channel) + "\n" + apiMessages;

        UpdateView();
    }

    public void Unsubscribe(){
        String channel = "" + this.textInputChannel.getText();
        String result = "";

        if(channel.equals(""))return;

        this.apiMessages = this.api.Unsubscribe(channel) + "\n" + apiMessages;

        UpdateView();
    }

    public void UpdateView(){
        this.textMessages.setText(this.apiMessages);
    }
}
