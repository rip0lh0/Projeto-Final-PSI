package pt.amsi.ipleiria.pet4all.Activities;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
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
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.R;

public class SearchMainActivity extends AppCompatActivity{
    private static final String URL_ANIMALS="http://192.168.1.73/v1/animal";

    List<Animal> animalList;
    RecyclerView recyclerView;

    @Override
    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_main);

        recyclerView=findViewById(R.id.recyclerView);
        recyclerView.setHasFixedSize(true);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        animalList= new ArrayList<>();
        loadAnimals();

    }

    private void loadAnimals(){
        StringRequest stringRequest= new StringRequest(Request.Method.GET,URL_ANIMALS, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Toast.makeText(SearchMainActivity.this, ""+animalList.size(), Toast.LENGTH_SHORT).show();
                try {
                    JSONArray array = new JSONArray(response);
                    for (int i = 0; i < array.length(); i++) {
                        JSONObject animal = array.getJSONObject(i);
                        String s = animal.getString("gender");
                        char gender = s.charAt(0);
                        animalList.add(new Animal(
                                animal.getInt("id"),
                                animal.getString("name"),
                                animal.getString("description"),
                                animal.getInt("id_coat"),
                                animal.getInt("id_energy"),
                                animal.getInt("id_size"),
                                animal.getString("chip"),
                                BigDecimal.valueOf(animal.getDouble("age")).floatValue(),
                                gender,
                                BigDecimal.valueOf(animal.getDouble("weight")).floatValue(),
                                animal.getInt("neutered")

                        ));
                    }
                    AnimalsListApdater adapter = new AnimalsListApdater(SearchMainActivity.this, animalList);
                    recyclerView.setAdapter(adapter);
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {

                        Toast.makeText(SearchMainActivity.this, "ERROU"+error, Toast.LENGTH_SHORT).show();
                        loadAnimals();
                    }
                }
        );
        Volley.newRequestQueue(this).add(stringRequest);
    }
}
