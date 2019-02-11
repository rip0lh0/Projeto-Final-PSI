package pt.amsi.ipleiria.pet4all.Activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Adapters.AdoptionsListAdapter;
import pt.amsi.ipleiria.pet4all.Adapters.AnimalsListAdapter;
import pt.amsi.ipleiria.pet4all.Interfaces.ListListener;
import pt.amsi.ipleiria.pet4all.Models.Adoption;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.Models.KennelAnimal;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.Singletons.AdoptionSingleton;

public class AdoptionsActivity extends AppCompatActivity implements ListListener<Adoption> {
    ArrayList<Adoption> adoptionList;
    ListView listView;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_adoptions);

        listView = findViewById(R.id.listview_adoptions);
        adoptionList = new ArrayList<>();

        AdoptionSingleton.getInstance(getApplicationContext()).setListListener(this);
        AdoptionSingleton.getInstance(getApplicationContext()).getAdoptions(getApplicationContext());

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Adoption tempAdoption = (Adoption) parent.getItemAtPosition(position);

                Intent intent = new Intent(getApplicationContext(), MessageActivity.class);

                intent.putExtra("IDKENNELANIMAL", tempAdoption.getKennelAnimal().getId() + "");
                startActivity(intent);
            }
        });
    }

    @Override
    public void onRefreshList(ArrayList<Adoption> list) {
        if(!list.isEmpty()){
            AdoptionsListAdapter adoptionsListAdapter = new AdoptionsListAdapter(this, list);
            listView.setAdapter(adoptionsListAdapter);

            adoptionsListAdapter.refresh(list);
            Log.e("ANIMAL_RESPONSE", adoptionsListAdapter.getCount()+"");
        }
    }

    @Override
    public void onUpdateList(Adoption item, int operacao) {

    }
}
