package pt.amsi.ipleiria.pet4all;

import android.os.Debug;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import org.eclipse.paho.client.mqttv3.IMqttDeliveryToken;
import org.eclipse.paho.client.mqttv3.MqttCallback;
import org.eclipse.paho.client.mqttv3.MqttClient;
import org.eclipse.paho.client.mqttv3.MqttException;
import org.eclipse.paho.client.mqttv3.MqttMessage;
import org.w3c.dom.Text;

import java.io.Console;

public class APIRest {
    private String server, port;
    private String clientID;

    public MqttClient mqttClient;

    public APIRest(String server, String port){
        this.server = server;
        this.port = port;
    }

    public APIRest(String server, String port, String clientID){
        this.server = server;
        this.port = port;
        this.clientID = clientID;
    }


    public void Connect() throws MqttException{
        this.mqttClient = new MqttClient(("tcp://" + this.server + ":" + this.port), this.clientID, null);
        this.mqttClient.connect();
    }

    public void Disconnect() throws MqttException{
        mqttClient.disconnect();
    }

    public String Subscribe(String channel){
        try {
            int subQoS= 0;
            mqttClient.subscribe(channel, subQoS);
            return "subscreveu " + channel;
        } catch (Exception e) {
            return "Impossivel Subscrever";
        }
    }

    public String Unsubscribe(String channel){
        try {
            String[] arrTopics = new String[1];
            arrTopics[0] = channel;

            mqttClient.unsubscribe(arrTopics);
            return "Removeu subscrição: " + arrTopics[0];
        } catch (Exception e) {
            return "Impossivel remover subscrição";
        }
    }

    public void setClientID(String clientID) {
        this.clientID = clientID + "-sub";
    }

}
