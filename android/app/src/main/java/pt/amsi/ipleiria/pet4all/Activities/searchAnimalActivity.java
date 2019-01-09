package pt.amsi.ipleiria.pet4all.Activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import pt.amsi.ipleiria.pet4all.R;

public class searchAnimalActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_animal);

    }

    public void onClickSearch(View view) {
        switch(view.getId()){
            case R.id.buttonShow:
            break;
            case R.id.buttonShowAll:
                Intent intentShowAll = new Intent(getApplicationContext(),AnimalsList.class);
                startActivity(intentShowAll);
                break;
        }
    }
}
