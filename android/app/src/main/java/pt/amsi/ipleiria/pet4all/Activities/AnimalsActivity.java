package pt.amsi.ipleiria.pet4all.Activities;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.ListView;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Adapters.ListAnimalsAdapter;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.R;

public class AnimalsActivity extends AppCompatActivity {
    private ListAnimalsAdapter animalsAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_animals);

        this.animalsAdapter = new ListAnimalsAdapter();

        ListView listView  = findViewById(R.id.animals_list);
        listView.setAdapter(this.animalsAdapter);

    }

    private void loadAnimalsToView(){
        ArrayList<Animal> animals = new ArrayList<Animal>();

        animals.add(new Animal("teste", "teste"));

        this.animalsAdapter.listAnimals = animals;
    }

    private void addAnimal(){

    }

    private void deleteAnimal(){

    }


}
