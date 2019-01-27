package pt.amsi.ipleiria.pet4all.Activities;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.NetworkError;
import com.android.volley.NoConnectionError;
import com.android.volley.ParseError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.ServerError;
import com.android.volley.TimeoutError;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;

import pt.amsi.ipleiria.pet4all.Adapters.AnimalsListApdater;
import pt.amsi.ipleiria.pet4all.Interfaces.ListListener;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.Singletons.AnimalSingleton;

public class AnimalsActivity extends AppCompatActivity implements ListListener<Animal> {
    private static final String URL_ANIMALS="http://192.168.1.198/v1/animal";

    ArrayList<Animal> animalList;
    ListView listView;

    @Override
    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_animals);

        listView = findViewById(R.id.listview_animal);
        animalList = new ArrayList<>();


        AnimalSingleton.getInstance(getApplicationContext()).setListListener(this);
        AnimalSingleton.getInstance(getApplicationContext()).getAllAnimal(getApplicationContext());
    }


    @Override
    public void onRefreshList(ArrayList<Animal> list) {
        if(!list.isEmpty()){
            AnimalsListApdater animalsListApdater = new AnimalsListApdater(this, list);
            listView.setAdapter(animalsListApdater);

            animalsListApdater.refresh(list);
            Log.e("ANIMAL_RESPONSE", animalsListApdater.getCount()+"");
        }
    }

    @Override
    public void onUpdateList(Animal item, int operacao) {

    }
}
