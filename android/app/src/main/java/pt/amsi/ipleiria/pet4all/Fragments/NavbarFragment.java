package pt.amsi.ipleiria.pet4all.Fragments;

import android.app.ActivityOptions;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.RelativeLayout;
import android.widget.TextView;

import pt.amsi.ipleiria.pet4all.Activities.LoginActivity;
import pt.amsi.ipleiria.pet4all.Activities.ProfileActivity;
import pt.amsi.ipleiria.pet4all.Activities.AnimalsActivity;
import pt.amsi.ipleiria.pet4all.MainActivity;
import pt.amsi.ipleiria.pet4all.PreferenceManager;
import pt.amsi.ipleiria.pet4all.R;

/* Controls All Navbar Actions And Animations */

public class NavbarFragment extends Fragment {
    Boolean navbarState = false; // True = Open : False = Close
    ImageButton btnSignout, btnProfile, btnAnimals;
    TextView textViewMagazine,textViewSearch,textViewProfile;
    RelativeLayout navbarActionBtns, navbarFragment;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.navbar_fragment, container, false);
        view.bringToFront();

        btnSignout = view.findViewById(R.id.btn_logout);
        if(PreferenceManager.hasKey("KEYCREDENTIALS", getActivity(), Context.MODE_PRIVATE)){
            btnSignout.setVisibility(View.VISIBLE);
            btnSignout.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    signout();
                }
            });
        }else{
            btnSignout.setVisibility(View.GONE);
        }

        btnAnimals = view.findViewById(R.id.btn_animals);
        btnAnimals.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                animals();
            }
        });

        btnProfile = (ImageButton)view.findViewById(R.id.btn_profile);
        btnProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                profile();
            }
        });

        return view;
    }

    public void animals(){
        Intent intent= new Intent(getActivity(), AnimalsActivity.class);

        ActivityOptions options = ActivityOptions.makeCustomAnimation(getContext(),android.R.anim.fade_in,android.R.anim.fade_out);
        startActivity(intent, options.toBundle());
    }


    public void profile(){
        Intent intent= new Intent(getActivity(), ProfileActivity.class);

        if(!PreferenceManager.hasKey("KEYCREDENTIALS", getActivity(), Context.MODE_PRIVATE)){
            intent= new Intent(getActivity(),LoginActivity.class);
        }

        ActivityOptions options = ActivityOptions.makeCustomAnimation(getContext(),android.R.anim.fade_in,android.R.anim.fade_out);
        startActivity(intent, options.toBundle());
    }


    public void signout(){
        if(getActivity().getClass().getName() == ProfileActivity.class.getName()){
            Intent intent= new Intent(getActivity(), MainActivity.class);

            ActivityOptions options = ActivityOptions.makeCustomAnimation(getContext(),android.R.anim.fade_in,android.R.anim.fade_out);
            startActivity(intent, options.toBundle());
        }

        PreferenceManager.removePreferences("KEYCREDENTIALS", getActivity(), Context.MODE_PRIVATE);

        btnSignout.setVisibility(View.GONE);
    }

}