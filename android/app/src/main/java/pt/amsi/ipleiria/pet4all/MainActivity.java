package pt.amsi.ipleiria.pet4all;

import android.content.Context;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        PreferenceManager.removePreferences("KEYCREDENTIALS", this, Context.MODE_PRIVATE);
    }


}
