package pt.amsi.ipleiria.pet4all.Activities;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.TextView;

import pt.amsi.ipleiria.pet4all.R;

public class MessageActivity extends AppCompatActivity {

    private TextView Message;
    private Button btnSendMsg;
    private TextView MsgDisplay;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_message);

    Message = findViewById(R.id.edtMessage);
    btnSendMsg = findViewById(R.id.btnSendMessage);
    MsgDisplay = findViewById(R.id.txtMsgDisplay);



    }

}
