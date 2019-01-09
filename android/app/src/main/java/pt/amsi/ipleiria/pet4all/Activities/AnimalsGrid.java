package pt.amsi.ipleiria.pet4all.Activities;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.GridView;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Fragments.AnimalDetailsFragment;
import pt.amsi.ipleiria.pet4all.Listeners.AnimalsListener;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.Singleton.SingletonAnimals;
import pt.amsi.ipleiria.pet4all.Utilities.AnimalJsonParser;

public class AnimalsGrid extends AppCompatActivity implements AnimalsListener {
    private GridView animalGridView;
    private ArrayList<Animal> animalsList;
    final static String ANIMAL_DETAILS = "Animal";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_animals_grid);

        //getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        SingletonAnimals.getInstance(getApplicationContext()).setAnimalsListener(this);
        SingletonAnimals.getInstance(getApplicationContext()).getAllAnimalsAPI(getApplicationContext(), AnimalJsonParser.isConnectedInternet(getApplicationContext()));

//        listaLivros = SingletonGestorLivros.getInstance(getApplicationContext()).getLivrosBD();
        animalGridView = (GridView) findViewById(R.id.gridviewAnimals);


        animalGridView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Animal tempAnimal = (Animal) parent.getItemAtPosition(position);
                Intent intent = new Intent(getApplicationContext(), AnimalDetailsFragment.class);
                intent.putExtra(ANIMAL_DETAILS, tempAnimal.getId());
                startActivity(intent);
            }
        });
    }
/*
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflater = getMenuInflater();
        inflater.inflate(R.menu.menu_grid_animals, menu);

        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()){
            case R.id.itemList:
                finish();
                Intent intentAnimalList = new Intent(getApplicationContext(), AnimalsList.class);
                startActivity(intentAnimalList);
                return true;
        }
        return super.onOptionsItemSelected(item);
    }*/

    @Override
    public void onRefreshAnimalsList(ArrayList<Animal> animalsList) {

    }

    @Override
    public void onUpdateAnimalsListDB(Animal animal, int action) {

    }
}
