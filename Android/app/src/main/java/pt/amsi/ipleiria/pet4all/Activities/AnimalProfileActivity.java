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
import android.widget.ImageView;
import android.widget.TextView;

import com.android.volley.Request;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.bumptech.glide.load.resource.drawable.GlideDrawable;
import com.bumptech.glide.request.RequestListener;
import com.bumptech.glide.request.target.Target;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.Helpers.AnimalsDBHelper;
import pt.amsi.ipleiria.pet4all.MainActivity;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.PreferenceManager;
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
    private ImageView ivBanner;
    private Button btnMessage;

    private Animal animal = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_animal_profile);

        final long id_animal = Long.parseLong(getIntent().getStringExtra("ANIMAL"));

        tvName = findViewById(R.id.profile_name);
        tvDescription = findViewById(R.id.profile_description);
        tvWeight = findViewById(R.id.profile_weight);
        tvEnergy = findViewById(R.id.profile_energy);
        tvSize = findViewById(R.id.profile_size);
        tvCoat_size = findViewById(R.id.profile_coat_size);
        tvAge = findViewById(R.id.profile_age);
        ivBanner = findViewById(R.id.profile_banner);

        btnMessage = findViewById(R.id.aprofile_message);
        btnMessage.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(!PreferenceManager.hasKey("KEYCREDENTIALS", AnimalProfileActivity.this, Context.MODE_PRIVATE)){
                    Intent intent = new Intent(AnimalProfileActivity.this, LoginActivity.class);

                    ActivityOptions options = ActivityOptions.makeCustomAnimation(AnimalProfileActivity.this,android.R.anim.fade_in,android.R.anim.fade_out);
                    startActivity(intent, options.toBundle());
                }else {
                    Intent intent = new Intent(AnimalProfileActivity.this, MessageActivity.class);
                    ActivityOptions options = ActivityOptions.makeCustomAnimation(AnimalProfileActivity.this, android.R.anim.fade_in, android.R.anim.fade_out);
                    intent.putExtra("created_at", animal.getCreated_at());
                    startActivity(intent, options.toBundle());
                }
            }
        });

        Log.e("ANIMAL_RESPONSE_ERROR", id_animal+"");

        animal = AnimalSingleton.getInstance(this).getAnimal(id_animal);
        Log.e("ANIMAL_RESPONSE_ERROR", animal.getName());

        if(animal == null){
            ConnectionManager connectionMng = new ConnectionManager(this);
            connectionMng.makeRequest(Request.Method.GET, " /"+id_animal, null, new ResponseManager() {
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

        if(ConnectionManager.checkInternetConnection(AnimalProfileActivity.this)) {
            String source_folder = "";
            source_folder = animal.getImagePath();
            if(source_folder == null) return;
            String source_path = "http://192.168.1.198/v1/animal/download-image?source_path=" + source_folder;

            Glide.with(AnimalProfileActivity.this)
                .load(source_path)
                .fitCenter()
                .listener(new RequestListener<String, GlideDrawable>() {
                    @Override
                    public boolean onException(Exception e, String model, Target<GlideDrawable> target, boolean isFirstResource) {
                        //progressBar.setVisibility(View.GONE);
                        return false;
                    }

                    @Override
                    public boolean onResourceReady(GlideDrawable resource, String model, Target<GlideDrawable> target, boolean isFromMemoryCache, boolean isFirstResource) {
                        //progressBar.setVisibility(View.GONE);
                        return false;
                    }
                })
                .error(R.drawable.ic_no_image)
                .diskCacheStrategy(DiskCacheStrategy.ALL)
                .into(ivBanner);
        }else{
            Glide.with(AnimalProfileActivity.this)
                .load(R.drawable.ic_no_image)
                .placeholder(R.drawable.ic_no_image)
                .into(ivBanner);
        }
    }

}
