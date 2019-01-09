package pt.amsi.ipleiria.pet4all.Activities;

import android.os.Bundle;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Spinner;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.Singleton.SingletonAnimals;

public class AnimalDetails extends AppCompatActivity {
    private EditText editTextName;
    private EditText editTextDescription;
    private EditText editTextWeight;
    private EditText editTextChip;
    private EditText editTextAge;
    private Spinner coatAddSpinner;
    private Spinner sizeAddSpinner;
    private Spinner energyAddSpinner;
    private Spinner neuteredAddSpinner;
    private Spinner genderAddSpinner;
    private Animal animal;
    private long idAnimal;

    private ArrayList<Animal> animalList;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.animal_details_add);

        //getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        editTextName = (EditText) findViewById(R.id.editTextName);
        editTextDescription= (EditText) findViewById(R.id.editTextDescription);
        editTextWeight= (EditText) findViewById(R.id.editTextWeight);
        editTextChip= (EditText) findViewById(R.id.editTextChip);
        editTextAge= (EditText) findViewById(R.id.editTextAge);
        coatAddSpinner= (Spinner) findViewById(R.id.coatAddSpinner);
        sizeAddSpinner= (Spinner)  findViewById(R.id.sizeAddSpinner);
        energyAddSpinner= (Spinner)  findViewById(R.id.energyAddSpinner);
        neuteredAddSpinner= (Spinner)  findViewById(R.id.neuteredAddSpinner);
        genderAddSpinner= (Spinner)  findViewById(R.id.genderAddSpinner);

        idAnimal = getIntent().getLongExtra(AnimalsList.ANIMAL_DETAILS,-1);



        if(idAnimal != -1)
        {
            animal = SingletonAnimals.getInstance(getApplicationContext()).getAnimal(idAnimal);
            setTitle("Detalhes: " + animal.getName());

            fillAnimalData();
        }
        else
        {
            setTitle("Adicionar animal:");
        }

    }
    private void fillAnimalData(){
        editTextName.setText(animal.getName());
        editTextDescription.setText(animal.getDescription());
        editTextWeight.setText(animal.getWeight());
        editTextChip.setText(animal.getChip());
        editTextAge.setText(animal.getAge());
        coatAddSpinner.setSelection(animal.getCoat());
        sizeAddSpinner.setSelection(animal.getSize());
        energyAddSpinner.setSelection(animal.getEnergy());
        neuteredAddSpinner.setSelection(animal.getNeutered());
        genderAddSpinner.setSelection(animal.getGender());
        /*Glide.with(getApplicationContext())
                .load(animal.getImage())
                .placeholder(R.drawable.error_dog)
                .fitCenter()
                .thumbnail(0f)
                .diskCacheStrategy(DiskCacheStrategy.ALL)
                .into(imageViewAnimal);*/
    }

    public void onClickAddAnimal(View view) {
        Long tsLong = System.currentTimeMillis()/1000;
        String ts = tsLong.toString();
        if (getTitle().toString().contains("Add"))
        {
            //String urlCapa = "http://amsi.dei.estg.ipleiria.pt/img/ipl_semfundo.png";

            Animal newAnimal = new Animal(animal.generateID(),editTextName.getText().toString(), editTextDescription.getText().toString(),coatAddSpinner.getSelectedItemPosition(),sizeAddSpinner.getSelectedItemPosition(),energyAddSpinner.getSelectedItemPosition(),editTextChip.getText().toString(),neuteredAddSpinner.getSelectedItemPosition(),genderAddSpinner.getSelectedItemPosition(), Integer.parseInt(editTextWeight.getText().toString()), Integer.parseInt(editTextAge.getText().toString()),ts,ts,0);
            SingletonAnimals.getInstance(getApplicationContext()).addAnimalsAPI(newAnimal,getApplicationContext());
            finish();
            Snackbar.make(getWindow().getDecorView().getRootView(), "guardado com sucesso", 10);
        }
        else
        {
            animal.setName(editTextName.getText().toString());
            animal.setDescription(editTextDescription.getText().toString());
            animal.setCoat(coatAddSpinner.getSelectedItemPosition());
            animal.setSize(sizeAddSpinner.getSelectedItemPosition());
            animal.setEnergy(energyAddSpinner.getSelectedItemPosition());
            animal.setChip(editTextChip.getText().toString());
            animal.setNeutered(neuteredAddSpinner.getSelectedItemPosition());
            animal.setGender(genderAddSpinner.getSelectedItemPosition());
            animal.setWeight(Integer.parseInt(editTextWeight.getText().toString()));
            animal.setCreated_at(null);
            animal.setUpdated_at(ts);
            animal.setStatus(0);
            SingletonAnimals.getInstance(getApplicationContext()).editAnimalsDB(animal);
        }
    }




}
