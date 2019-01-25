package pt.amsi.ipleiria.pet4all.Fragments;

import android.app.ActivityOptions;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.ImageButton;
import android.widget.RelativeLayout;
import android.widget.TextView;

import pt.amsi.ipleiria.pet4all.Activities.LoginActivity;
import pt.amsi.ipleiria.pet4all.R;

/* Controls All Navbar Actions And Animations */

public class NavbarFragment extends Fragment {
    Boolean navbarState = false; // True = Open : False = Close
    ImageButton btnDropDown, btnProfile, btnSearch, btnMagazine;
    TextView textViewMagazine,textViewSearch,textViewProfile;
    RelativeLayout navbarActionBtns, navbarFragment;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.navbar_fragment, container, false);
        view.bringToFront();
        navbarFragment = (RelativeLayout) view.findViewById(R.id.navbarFragment);
        navbarFragment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(navbarState) toggleDropDown(view);
            }
        });

        /* Action Buttons */
        navbarActionBtns = (RelativeLayout) view.findViewById(R.id.nb_action_btn);
        /* Button Actions */
        btnDropDown = (ImageButton)view.findViewById(R.id.btn_dropdown);
        btnDropDown.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                toggleDropDown(view);
            }
        });
        btnProfile = (ImageButton)view.findViewById(R.id.btnProfile);
        btnProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent= new Intent(getActivity(),LoginActivity.class);
                ActivityOptions options = ActivityOptions.makeCustomAnimation(getContext(),android.R.anim.fade_in,android.R.anim.fade_out);
                startActivity(intent, options.toBundle());
            }
        });

        return view;
    }

    public void toggleDropDown(View view) {
        navbarState = !navbarState;
        /* Change Layout Params For Closing Action */
        ViewGroup.LayoutParams params = navbarFragment.getLayoutParams();
        params.height = (navbarState) ? ViewGroup.LayoutParams.MATCH_PARENT : ViewGroup.LayoutParams.WRAP_CONTENT;
        navbarFragment.setLayoutParams(params);
        /* Change Button Image */
        btnDropDown.setImageResource((navbarState) ? R.drawable.ic_action_drop_up : R.drawable.ic_action_drop_down);
        /* Set Correct Animation */
        Animation anim = AnimationUtils.loadAnimation(getActivity(), (navbarState) ? R.anim.fade_in : R.anim.fade_out);
        navbarActionBtns.setVisibility(View.VISIBLE);
        navbarActionBtns.startAnimation(anim);
        anim.setAnimationListener(new Animation.AnimationListener() {
            @Override
            public void onAnimationStart(Animation animation) {}

            @Override
            public void onAnimationEnd(Animation animation) {
                if(!navbarState) navbarActionBtns.setVisibility(View.GONE);
                animation.cancel();
            }

            @Override
            public void onAnimationRepeat(Animation animation) {}
        });
    }
}