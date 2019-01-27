package pt.amsi.ipleiria.pet4all.Activities;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.EditText;

import pt.amsi.ipleiria.pet4all.R;

public class RegisterActivity extends AppCompatActivity {

    // UI references.
    private EditText etUsername;
    private EditText etName;
    private EditText etEmail;
    private EditText etPassword;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
    }
}
