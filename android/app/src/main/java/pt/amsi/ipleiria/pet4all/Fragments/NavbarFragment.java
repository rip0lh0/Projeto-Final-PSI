package pt.amsi.ipleiria.pet4all.Fragments;

import android.app.ActivityOptions;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.RelativeLayout;
import android.widget.TextView;

import pt.amsi.ipleiria.pet4all.Activities.AdoptionsActivity;
import pt.amsi.ipleiria.pet4all.Activities.AnimalProfileActivity;
import pt.amsi.ipleiria.pet4all.Activities.LoginActivity;
import pt.amsi.ipleiria.pet4all.Activities.ProfileActivity;
import pt.amsi.ipleiria.pet4all.Activities.AnimalsActivity;
import pt.amsi.ipleiria.pet4all.MainActivity;
import pt.amsi.ipleiria.pet4all.PreferenceManager;
import pt.amsi.ipleiria.pet4all.R;

/* Controls All Navbar Actions And Animations */

public class NavbarFragment extends Fragment {

    ImageButton btnMessages, btnProfile, btnAnimals;

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.navbar_fragment, container, false);
        view.bringToFront();

        btnMessages = view.findViewById(R.id.btn_messages);

        if(PreferenceManager.hasKey("KEYCREDENTIALS", getActivity(), Context.MODE_PRIVATE)){
            btnMessages.setVisibility(View.VISIBLE);
            btnMessages.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    messages();
                }
            });
        }else{
            btnMessages.setVisibility(View.GONE);
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
        Log.e("PROFILE", "CLICK");
        Intent intent = new Intent(getActivity(), ProfileActivity.class);

        /*if(!PreferenceManager.hasKey("KEYCREDENTIALS", getActivity(), Context.MODE_PRIVATE)){
            intent = new Intent(getActivity(),LoginActivity.class);
        }*/

        //ActivityOptions options = ActivityOptions.makeCustomAnimation(getContext(),android.R.anim.fade_in,android.R.anim.fade_out);
        startActivity(intent);
    }


    public void messages(){
        Intent intent= new Intent(getActivity(), AdoptionsActivity.class);

        if(!PreferenceManager.hasKey("KEYCREDENTIALS", getActivity(), Context.MODE_PRIVATE)){
            intent= new Intent(getActivity(),LoginActivity.class);
        }

        ActivityOptions options = ActivityOptions.makeCustomAnimation(getContext(),android.R.anim.fade_in,android.R.anim.fade_out);
        startActivity(intent, options.toBundle());
        getActivity().finish();
    }


}