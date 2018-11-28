package pt.amsi.ipleiria.pet4all;

import android.animation.AnimatorSet;
import android.content.Context;
import android.media.Image;
import android.net.Uri;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.AnimationSet;
import android.view.animation.AnimationUtils;
import android.view.animation.RotateAnimation;
import android.widget.ImageButton;
import android.widget.RelativeLayout;


public class SettingsFragment extends Fragment {
    Boolean settingsState=false;    // True = Open : False = Close
    ImageButton btnSettings,btnReport,btnEditProfile;
    RelativeLayout settingsFragment,settingsActionbtns;
    Animation slide_right,slide_left,fadeout,fadein;

    Animation visibleTrue = new AnimationSet(true);
    Animation visibleFalse = new AnimationSet(true);

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.fragment_settings, container, false);
        view.bringToFront();
        settingsFragment = (RelativeLayout) view.findViewById(R.id.settingsFragment);
        Log.e("teste","--> " + settingsFragment.toString());
        settingsFragment.setOnClickListener(new View.OnClickListener() {
          @Override
            public void onClick(View view) {

                if(settingsState) toggleDropDown(view);
            }
       });
        /* Action Buttons */
        /* Button Actions */
        btnSettings = (ImageButton)view.findViewById(R.id.buttonSettings);
        Log.e("teste","--> " + settingsFragment.toString());
        btnSettings.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Log.e("teste","--> Teste");
                toggleDropDown(view);
            }
        });

        return inflater.inflate(R.layout.fragment_settings, container, false);
    }
    public void toggleDropDown(View view) {
        //ViewGroup.LayoutParams params = settingsFragment.getLayoutParams();
        //params.height = (settingsState) ? ViewGroup.LayoutParams.MATCH_PARENT : ViewGroup.LayoutParams.WRAP_CONTENT;
        //settingsFragment.setLayoutParams(params);
        /* Rotate Button */


        if (settingsState){
            RotateAnimation rotationgo = new RotateAnimation(0,60);
            btnSettings.startAnimation(rotationgo);
            Animation anim = AnimationUtils.loadAnimation(getActivity(), (settingsState) ? R.anim.fade_in : R.anim.fade_out);
            slide_left = AnimationUtils.loadAnimation(getActivity(), R.anim.slide_left_settings);
            slide_right = AnimationUtils.loadAnimation(getActivity(), R.anim.slide_right_settings);

            ((AnimationSet) visibleTrue).addAnimation(fadein);
            ((AnimationSet) visibleTrue).addAnimation(slide_right);
            ((AnimationSet) visibleFalse).addAnimation(fadeout);
            ((AnimationSet) visibleFalse).addAnimation(slide_left);
            openMenu(view);

        } else {
            RotateAnimation rotationback = new RotateAnimation(60,0);
            btnSettings.startAnimation(rotationback);
            closeMenu(view);
        }


        /*set correct animations*/


    }
    public void closeMenu(View view ){
        btnEditProfile=(ImageButton) view.findViewById(R.id.buttonEditProfile);
        btnReport=(ImageButton) view.findViewById(R.id.buttonReportAbuse);
        btnEditProfile.startAnimation(visibleFalse);
        btnReport.startAnimation(visibleFalse);
        visibleFalse.setAnimationListener(new Animation.AnimationListener() {
            @Override
            public void onAnimationStart(Animation animation) {

            }

            @Override
            public void onAnimationEnd(Animation animation) {
                btnEditProfile.setVisibility(View.GONE);
                btnReport.setVisibility(View.GONE);
                animation.cancel();
            }

            @Override
            public void onAnimationRepeat(Animation animation) {

            }
        });



    }
    public void openMenu(View view ) {
        btnEditProfile=(ImageButton) view.findViewById(R.id.buttonEditProfile);
        btnEditProfile.startAnimation(visibleTrue);
        btnReport.startAnimation(visibleTrue);
        visibleTrue.setAnimationListener(new Animation.AnimationListener() {
            @Override
            public void onAnimationStart(Animation animation) {
            btnEditProfile.setVisibility(View.VISIBLE);
            btnReport.setVisibility(View.VISIBLE);
            }

            @Override

            public void onAnimationEnd(Animation animation) {
                animation.cancel();
            }

            @Override
            public void onAnimationRepeat(Animation animation) {

            }
        });
    }
    // TODO: Rename method, update argument and hook method into UI event
    public void onButtonPressed(Uri uri) {

    }
}

