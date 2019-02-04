package pt.amsi.ipleiria.pet4all.Activities;

import android.app.ActivityOptions;
import android.content.Context;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.bumptech.glide.load.resource.drawable.GlideDrawable;
import com.bumptech.glide.request.RequestListener;
import com.bumptech.glide.request.target.Target;

import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.Models.KennelAnimal;
import pt.amsi.ipleiria.pet4all.PreferenceManager;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.Singletons.KennelAnimalSingleton;

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

    private KennelAnimal kennelAnimal = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_animal_profile);

        final long id_kenneAnimal = Long.parseLong(getIntent().getStringExtra("ANIMAL"));

        tvName = findViewById(R.id.profile_name);
        tvDescription = findViewById(R.id.profile_description);
        tvWeight = findViewById(R.id.profile_weight);
        tvEnergy = findViewById(R.id.profile_energy);
        tvSize = findViewById(R.id.profile_size);
        tvCoat_size = findViewById(R.id.profile_coat_size);
        tvAge = findViewById(R.id.profile_age);
        ivBanner = findViewById(R.id.profile_banner);

        kennelAnimal = KennelAnimalSingleton.getInstance(this).getKennelAnimal(id_kenneAnimal);

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

                intent.putExtra("IDKENNELANIMAL", kennelAnimal.getId() + "");
                Log.e("MESSAGE", kennelAnimal.getId() + "");
                startActivity(intent, options.toBundle());
            }
            }
        });

        fillFields(kennelAnimal);
    }

    public void fillFields(KennelAnimal kennelAnimal){
        Animal tempAnimal = kennelAnimal.getAnimal();

        tvName.setText("Nome: " + ((tempAnimal.getName() != null) ? tempAnimal.getName() : ""));
        tvDescription.setText("Descrição: " + ((tempAnimal.getDescription() != null) ? tempAnimal.getDescription() : ""));
        tvWeight.setText("Peso: " + ((tempAnimal.getWeight() != 0) ? tempAnimal.getWeight()+"" : "-"));
        tvEnergy.setText("Energia: " + ((tempAnimal.getEnergy() != null) ? tempAnimal.getEnergy() : ""));
        tvSize.setText("Tamanho: " + ((tempAnimal.getSize() != null) ? tempAnimal.getSize() : ""));
        tvCoat_size.setText("Pelo: " + ((tempAnimal.getCoat() != null) ? tempAnimal.getCoat() : ""));
        tvAge.setText("Idade: " + ((tempAnimal.getAge() != 0) ? tempAnimal.getAge()+"" : "-"));

        if(!ConnectionManager.checkInternetConnection(this)){
            Glide.with(AnimalProfileActivity.this)
                .load(R.drawable.ic_no_image)
                .placeholder(R.drawable.ic_no_image)
                .into(ivBanner);
            return;
        }else{
            String source_folder = "";

            source_folder = kennelAnimal.getKennel().getId() + "/" + kennelAnimal.getCreated_at() + "/0.jpg" ;

            if(source_folder.isEmpty()) return;
            String source_path = ConnectionManager.PREFIX_URL + "animal/download-image?source_path=" + source_folder;

            Log.e("IMAGES_PATH", source_path);

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
        }
    }

}
