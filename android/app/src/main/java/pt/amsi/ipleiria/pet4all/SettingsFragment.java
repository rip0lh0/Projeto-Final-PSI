package pt.amsi.ipleiria.pet4all;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.AccelerateDecelerateInterpolator;
import android.view.animation.Animation;
import android.view.animation.AnimationSet;
import android.view.animation.AnimationUtils;
import android.view.animation.RotateAnimation;
import android.widget.FrameLayout;
import android.widget.ImageButton;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;


public class SettingsFragment extends Fragment {
    Boolean settingsState=false;    // True = Open : False = Close
    ImageButton btnSettings,btnReport,btnEditProfile;
    RelativeLayout settingsFragment;
    LinearLayout settingsActionBtns;
    Animation slide_right,slide_left;
    Boolean windowState=false;      // True = Open : False = Close
    FrameLayout reportWindow;

    Animation visibleTrue = new AnimationSet(true);
    Animation visibleFalse = new AnimationSet(true);
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {

        View view = inflater.inflate(R.layout.fragment_settings, container, false);
        view.bringToFront();
        loadanimations();
        settingsFragment = (RelativeLayout) view.findViewById(R.id.settingsFragment);
        /* Action Buttons */
        settingsActionBtns = (LinearLayout) view.findViewById(R.id.settingsActionBtns);
        /* Button Actions */
        btnSettings = view.findViewById(R.id.buttonSettings);
        btnSettings.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                toggleDropDown(view);
            }
        });
        reportWindow = (FrameLayout) view.findViewById(R.id.reportFragment);
        reportWindow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                reportWindow.setVisibility(View.GONE);
                windowState=!windowState;
            }
        });
        btnReport = view.findViewById(R.id.buttonReportAbuse);
        btnReport.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                toggleDropDown(view);
                windowState=!windowState;
                if (windowState){
                    reportWindow.setVisibility(View.VISIBLE);
                }
            }
        });

        return view;
    }

    public void toggleDropDown(View view) {
        settingsState=!settingsState;
        ViewGroup.LayoutParams params = settingsFragment.getLayoutParams();
        params.height = (settingsState) ? ViewGroup.LayoutParams.MATCH_PARENT : ViewGroup.LayoutParams.WRAP_CONTENT;
        settingsFragment.setLayoutParams(params);
        /* Rotate Button */
        if (settingsState){
            float deg = btnSettings.getRotation() - 180F;
            btnSettings.animate().rotation(deg).setInterpolator(new AccelerateDecelerateInterpolator());
            openMenu(view);

        } else {
            float deg = btnSettings.getRotation() + 180F;
            btnSettings.animate().rotation(deg).setInterpolator(new AccelerateDecelerateInterpolator());
            closeMenu(view);
        }

    }

    public void closeMenu(View view){
        settingsActionBtns.startAnimation(visibleFalse);
        visibleFalse.setFillBefore(false);
        visibleFalse.setFillAfter(false);
        visibleFalse.setAnimationListener(new Animation.AnimationListener() {
            @Override
            public void onAnimationStart(Animation animation) {

            }

            @Override
            public void onAnimationEnd(Animation animation) {

                settingsActionBtns.setVisibility(View.INVISIBLE);
            }

            @Override
            public void onAnimationRepeat(Animation animation) {

            }
        });



    }

    public void openMenu(View view) {
        settingsActionBtns.startAnimation(visibleTrue);
        visibleTrue.setFillBefore(false);
        visibleTrue.setFillAfter(true);
        visibleTrue.setAnimationListener(new Animation.AnimationListener() {
            @Override
            public void onAnimationStart(Animation animation) {
                settingsActionBtns.setVisibility(View.VISIBLE);
            }

            @Override

            public void onAnimationEnd(Animation animation) {


            }

            @Override
            public void onAnimationRepeat(Animation animation) {

            }
        });
    }

    public void loadanimations(){
        slide_left = AnimationUtils.loadAnimation(getActivity(), R.anim.slide_left_settings);
        slide_right = AnimationUtils.loadAnimation(getActivity(), R.anim.slide_right_settings);
        ((AnimationSet) visibleTrue).addAnimation(slide_right);
        ((AnimationSet) visibleFalse).addAnimation(slide_left);
    }
    // TODO: Rename method, update argument and hook method into UI event
}

