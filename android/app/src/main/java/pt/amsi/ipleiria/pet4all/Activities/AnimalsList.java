package pt.amsi.ipleiria.pet4all.Activities;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.view.MenuItemCompat;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.SearchView;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Adapters.AnimalListAdapter;
import pt.amsi.ipleiria.pet4all.Listeners.AnimalsListener;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.Singleton.SingletonAnimals;
import pt.amsi.ipleiria.pet4all.Utilities.AnimalJsonParser;

public class AnimalsList extends AppCompatActivity implements AnimalsListener {
    private ListView animalListView;
    private ArrayList<Animal> animalsList;
    final static String ANIMAL_DETAILS = "Animal";
    final static String ANIMAL_LIST = "Animal list";
    public String saveState;
    public String email;

    SharedPreferences sharedPref;
    SharedPreferences.Editor editor;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_animals_list);

        setTitle("Lista dos Animais");

        sharedPref = getPreferences(Context.MODE_PRIVATE);
        editor = sharedPref.edit();

        Intent intentReceivedLogin = getIntent();
        email = intentReceivedLogin.getStringExtra("EMAIL");


        if(email == null)
            email = sharedPref.getString("email", "Não existe");
        else{
            editor.putString("email", email);
            editor.commit();
        }

        SingletonAnimals.getInstance(getApplicationContext()).setAnimalsListener(this);
        //getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        Toast.makeText(this, email, Toast.LENGTH_SHORT).show();
        SingletonAnimals.getInstance(getApplicationContext()).getAllAnimalsAPI(getApplicationContext(), AnimalJsonParser.isConnectedInternet(getApplicationContext()));
//        listaLivros = SingletonGestorLivros.getInstance(getApplicationContext()).getLivrosBD();
        animalListView = (ListView) findViewById(R.id.listviewAnimalsList);





        animalListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Animal tempAnimal = (Animal) parent.getItemAtPosition(position);
                Intent intent = new Intent(getApplicationContext(), AnimalDetails.class);
                intent.putExtra(ANIMAL_DETAILS, tempAnimal.getId());
                startActivity(intent);
            }
        });

        final SwipeRefreshLayout swipeRefreshLayout = findViewById(R.id.swiperefresh);
        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                SingletonAnimals.getInstance(getApplicationContext()).getAllAnimalsAPI(getApplicationContext(), AnimalJsonParser.isConnectedInternet(getApplicationContext()));
//                lvListView.setAdapter(new ListaLivroAdaptador(getApplicationContext(), listaLivros));
                swipeRefreshLayout.setRefreshing(false);
            }
        });
    }
    public void onClickAddAnimal(View view) {
        Intent intentNewAnimal = new Intent(getApplicationContext(),AnimalDetails.class);
        startActivity(intentNewAnimal);
    }
    /*
   @Override
   public boolean onCreateOptionsMenu(Menu menu) {
       MenuInflater inflater = getMenuInflater();
       inflater.inflate(R.menu.menu_lista_livros, menu);

       //Ex 11
       MenuItem searchItem = menu.findItem(R.id.searchItem);
       SearchView searchView = (SearchView)  MenuItemCompat.getActionView(searchItem);
       searchView.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
           @Override
           public boolean onQueryTextSubmit(String s) {
               return false;
           }

           @Override
           public boolean onQueryTextChange(String s) {
               ArrayList<Animal> tempAnimalsList = new ArrayList<Animal>();
               for(Animal animal :SingletonAnimals.getInstance(getApplicationContext()).getAnimalsDB())
               {
                   if(animal.getName().toLowerCase().contains(s.toLowerCase())){
                       tempAnimalsList.add(animal);
                   }
               }
               animalListView.setAdapter(new AnimalListAdapter(AnimalsList.this, tempAnimalsList));
               return true;
           }
       });


       return super.onCreateOptionsMenu(menu);
   }

       @Override
      public boolean onOptionsItemSelected(MenuItem item) {
           switch (item.getItemId()){
               case R.id.gridItem:
                   finish();
                   Intent intentAnimalGrid = new Intent(getApplicationContext(), AnimalsGrid.class);
                   startActivity(intentAnimalGrid);
                   return true;

               case R.id.emailItem:
                   Intent intentSendMail = new Intent(Intent.ACTION_SENDTO);

                   intentSendMail.setType("text/plain");
                   intentSendMail.setData(Uri.parse("mailto:" + email));
                   //intentSendMail.setDataAndType(Uri.parse("mailto:" + mail),"text/plain");
                   intentSendMail.putExtra(Intent.EXTRA_SUBJECT, "AMSI 2017/18");
                   intentSendMail.putExtra(Intent.EXTRA_TEXT, "Olá " + email + " isto é uma mensagem de teste, enviado pela minha aplicação :)" );

                   if(intentSendMail.resolveActivity(getPackageManager()) != null){
                       startActivity(intentSendMail);
                   }
           }
           return super.onOptionsItemSelected(item);
       }*/
    @Override
    public void onRefreshAnimalsList(ArrayList<Animal> animalsList) {
        if(!animalsList.isEmpty()){
            AnimalListAdapter animalListAdapter = new AnimalListAdapter(this, animalsList);
            animalListView.setAdapter(animalListAdapter);
            animalListAdapter.refresh(animalsList);
        }
    }

    @Override
    public void onUpdateAnimalsListDB(Animal animal, int action) {

    }
    @Override
    protected void onPostResume() {
        super.onPostResume();
        SingletonAnimals.getInstance(getApplicationContext()).getAllAnimalsAPI(getApplicationContext(), AnimalJsonParser.isConnectedInternet(getApplicationContext()));
    }
}
