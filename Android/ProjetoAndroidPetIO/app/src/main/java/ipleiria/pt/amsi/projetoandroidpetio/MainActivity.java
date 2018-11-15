package ipleiria.pt.amsi.projetoandroidpetio;
import android.content.Intent;
import android.content.res.Configuration;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Layout;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.AnimationSet;
import android.view.animation.AnimationUtils;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;


public class MainActivity extends AppCompatActivity {
    boolean NavStatus = false;
    boolean AnimStatus=false;
    ImageButton btnProfile ;
    ImageButton btnMagazine ;
    ImageButton btnSearch ;
    Animation down ;
    Animation up ;
    Animation fadeout ;
    Animation fadein ;
    Animation visibleTrue = new AnimationSet(true);
    Animation visibleFalse = new AnimationSet(true);
    TextView txtSearch;
    TextView txtMagazine;
    TextView txtProfile;


    protected void onCreate(Bundle savedInstanceState,View currentView) {
        super.onCreate(savedInstanceState);
        setContentView(currentView);
        setAssets();
        loadAnimations();
    }

    public void buttonView(View view) {

        NavStatus=toggleMenu(NavStatus);
    }
    public boolean toggleMenu(boolean NavStatus){
        if (!NavStatus){
                NavStatus=true;
                openMenu();
        }else {
                NavStatus =false;
                closeMenu();
        }
        return NavStatus;
    }
    public void openMenu(){


        btnProfile.startAnimation(visibleTrue);
        btnSearch.startAnimation(visibleTrue);
        btnMagazine.startAnimation(visibleTrue);
        visibleTrue.setAnimationListener(new Animation.AnimationListener() {
            @Override
            public void onAnimationStart(Animation animation) {
            btnMagazine.setVisibility(View.VISIBLE);
            btnMagazine.setAlpha(1.0f);
            }

            @Override

            public void onAnimationEnd(Animation animation) {
                ViewGroup.MarginLayoutParams marginParamsbtn = (ViewGroup.MarginLayoutParams) btnMagazine.getLayoutParams();
                ViewGroup.MarginLayoutParams marginParamstxtMagazine = (ViewGroup.MarginLayoutParams) txtMagazine.getLayoutParams();
                ViewGroup.MarginLayoutParams marginParamstxtSearch = (ViewGroup.MarginLayoutParams) txtSearch.getLayoutParams();
                ViewGroup.MarginLayoutParams marginParamstxtProfile = (ViewGroup.MarginLayoutParams) txtProfile.getLayoutParams();
                marginParamsbtn.setMargins(0,120,0,0);
                marginParamstxtMagazine.setMargins(+57,360,0,0);
                marginParamstxtSearch.setMargins(+53,360,0,0);
                marginParamstxtProfile.setMargins(+75,360,0,0);


                btnMagazine.setVisibility(View.VISIBLE);
                btnProfile.setVisibility(View.VISIBLE);
                btnSearch.setVisibility(View.VISIBLE);
                btnSearch.setEnabled(true);
                btnProfile.setEnabled(true);
                btnMagazine.setEnabled(true);
                txtMagazine.setVisibility(View.VISIBLE);
                txtSearch.setVisibility(View.VISIBLE);
                txtProfile.setVisibility(View.VISIBLE);

            }

            @Override
            public void onAnimationRepeat(Animation animation) {

            }
        });
        //region button visibility and enabled Visible/true

        //endregion




    }
    public void closeMenu(){

        btnProfile.startAnimation(visibleFalse);
        btnSearch.startAnimation(visibleFalse);
        btnMagazine.startAnimation(visibleFalse);
        visibleFalse.setAnimationListener(new Animation.AnimationListener() {
            @Override
            public void onAnimationStart(Animation animation) {
                txtMagazine.setVisibility(View.INVISIBLE);
                txtSearch.setVisibility(View.INVISIBLE);
                txtProfile.setVisibility(View.INVISIBLE);
            }

            @Override
            public void onAnimationEnd(Animation animation) {
                btnProfile.setVisibility(View.GONE);
                btnProfile.setEnabled(false);
                btnSearch.setVisibility(View.GONE);
                btnSearch.setEnabled(false);
                btnMagazine.setVisibility(View.GONE);
                btnMagazine.setEnabled(false);


            }

            @Override
            public void onAnimationRepeat(Animation animation) {

            }
        });

        //region button visibility and enabled gone/false

        //endregion

    }
    public void setAssets(){
        btnProfile = findViewById(R.id.buttonProfile);
        btnMagazine = findViewById(R.id.buttonMagazine);
        btnSearch = findViewById(R.id.buttonSearch);
        txtSearch = findViewById(R.id.textViewSearch);
        txtMagazine = findViewById(R.id.textViewMagazine);
        txtProfile = findViewById(R.id.textViewProfile);
    }
    public void loadAnimations() {
        down = AnimationUtils.loadAnimation(this, R.anim.button_down);
        up = AnimationUtils.loadAnimation(this, R.anim.button_up);
        fadeout = AnimationUtils.loadAnimation(this, R.anim.fade_out);
        fadein = AnimationUtils.loadAnimation(this, R.anim.fade_in);
        ((AnimationSet) visibleTrue).addAnimation(fadein);
        ((AnimationSet) visibleTrue).addAnimation(down);
        ((AnimationSet) visibleFalse).addAnimation(fadeout);
        ((AnimationSet) visibleFalse).addAnimation(up);
    }

    public void buttonTopMenu(View view) {
        switch (view.getId()){
            case R.id.buttonProfile:
                Intent intent = new Intent(this, LoginProfileActivity.class);
                this.startActivity(intent);
                break;
        }
    }
}

