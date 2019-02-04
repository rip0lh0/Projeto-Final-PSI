package pt.amsi.ipleiria.pet4all.Activities;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Adapters.AnimalsListAdapter;
import pt.amsi.ipleiria.pet4all.Interfaces.ListListener;
import pt.amsi.ipleiria.pet4all.Models.KennelAnimal;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.Singletons.AdoptionSingleton;
import pt.amsi.ipleiria.pet4all.Singletons.KennelAnimalSingleton;

public class AnimalsActivity extends AppCompatActivity implements ListListener<KennelAnimal> {
    ArrayList<KennelAnimal> arrListKennelAnimals;
    ListView listView;

    @Override
    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_animals);

        listView = findViewById(R.id.listview_animal);
        arrListKennelAnimals = new ArrayList<>();

        AdoptionSingleton.getInstance(getApplicationContext()).getAdoptions(getApplicationContext());

        KennelAnimalSingleton.getInstance(getApplicationContext()).setListListener(this);
        KennelAnimalSingleton.getInstance(getApplicationContext()).getKennelAnimals(getApplicationContext());

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                KennelAnimal tempKennelAnimal = (KennelAnimal) parent.getItemAtPosition(position);

                Intent intent = new Intent(getApplicationContext(), AnimalProfileActivity.class);

                intent.putExtra("ANIMAL", tempKennelAnimal.getId() + "");
                startActivity(intent);
            }
        });
    }


    @Override
    public void onRefreshList(ArrayList<KennelAnimal> list) {
        if(!list.isEmpty()){
            AnimalsListAdapter animalsListAdapter = new AnimalsListAdapter(this, list);
            listView.setAdapter(animalsListAdapter);

            animalsListAdapter.refresh(list);
            Log.e("ANIMAL_RESPONSE", animalsListAdapter.getCount()+"");
        }
    }

    @Override
    public void onUpdateList(KennelAnimal item, int operacao) {

    }
}
