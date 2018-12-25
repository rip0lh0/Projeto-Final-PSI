package pt.amsi.ipleiria.pet4all;

import android.app.Activity;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;

public class RegisterMenuActivity extends AppCompatActivity {

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
                intent = new Intent(this, RegisterUserActivity.class);
                break;

            case R.id.buttonKennel:
                intent = new Intent(this, RegisterKennelActivity.class);
                break;
        }
        startActivity(intent);

    }
}
