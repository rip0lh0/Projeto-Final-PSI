package pt.amsi.ipleiria.pet4all.Activities;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;

import pt.amsi.ipleiria.pet4all.R;

public class SignupMenuActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_menu);
    }

    public void btnRegister(View view) {
        Intent intent = new Intent();
        switch (view.getId()) {
            case R.id.buttonUser:
                Log.e("v","está cheio de erro");
                intent = new Intent(this, SignupUserActivity.class);
                break;

            case R.id.buttonKennel:
                intent = new Intent(this, SignupKennelActivity.class);
                break;
        }
        startActivity(intent);

    }
}
