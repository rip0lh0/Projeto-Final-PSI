package pt.amsi.ipleiria.pet4all.Activities;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.android.volley.Request;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.Helpers.AnimalsDBHelper;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.ResponseManager;
import pt.amsi.ipleiria.pet4all.Singletons.AnimalSingleton;

public class AnimalProfileActivity extends AppCompatActivity {

    private TextView tvName;
    private TextView tvDescription;
    private TextView tvWeight;
    private TextView tvEnergy;
    private TextView tvSize;
    private TextView tvCoat_size;
    private TextView tvAge;
    private Button btnMessage;

    private Animal animal = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_animal_profile);

        long id_animal = Long.parseLong(getIntent().getStringExtra("ANIMAL"));

        tvName = findViewById(R.id.profile_name);
        tvDescription = findViewById(R.id.profile_description);
        tvWeight = findViewById(R.id.profile_weight);
        tvEnergy = findViewById(R.id.profile_energy);
        tvSize = findViewById(R.id.profile_size);
        tvCoat_size = findViewById(R.id.profile_coat_size);
        tvAge = findViewById(R.id.profile_age);

        btnMessage = findViewById(R.id.aprofile_message);
        btnMessage.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

            }
        });

        Log.e("ANIMAL_RESPONSE_ERROR", id_animal+"");

        animal = AnimalSingleton.getInstance(this).getAnimal(id_animal);
        Log.e("ANIMAL_RESPONSE_ERROR", animal.getName());

        if(animal == null){
            ConnectionManager connectionMng = new ConnectionManager(this);
            connectionMng.makeRequest(Request.Method.GET, "animal/"+id_animal, null, new ResponseManager() {
                @Override
                public void onResponse(JSONObject response) {
                    try {
                        String arrAnimals = response.getString("success");
                        animal = Animal.parserJsonAnimal(arrAnimals, AnimalProfileActivity.this);

                        fillFields(animal);

                    } catch (JSONException e) {
                        Log.e("ANIMAL_RESPONSE_ERROR", e.toString());
                    }
                }

                @Override
                public void onError(String message) {
                    Log.e("ANIMAL_RESPONSE_ERROR", message);
                }
            });
        }else{
            fillFields(animal);
        }
    }

    public void fillFields(Animal animal){
        tvName.setText("Nome: " + ((animal.getName() != null) ? animal.getName() : ""));
        tvDescription.setText("Descrição: " + ((animal.getDescription() != null) ? animal.getDescription() : ""));
        tvWeight.setText("Peso: " + ((animal.getWeight() != 0) ? animal.getWeight()+"" : "-"));
        tvEnergy.setText("Energia: " + ((animal.getEnergy() != null) ? animal.getEnergy() : ""));
        tvSize.setText("Tamanho: " + ((animal.getSize() != null) ? animal.getSize() : ""));
        tvCoat_size.setText("Pelo: " + ((animal.getCoat() != null) ? animal.getCoat() : ""));
        tvAge.setText("Idade: " + ((animal.getAge() != 0) ? animal.getAge()+"" : "-"));
    }

}
