package pt.amsi.ipleiria.pet4all.Fragments;

import android.content.Context;
import android.net.Uri;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RelativeLayout;
import android.widget.Spinner;

import pt.amsi.ipleiria.pet4all.R;


public class ReportFragment extends Fragment {
    RelativeLayout reportFragment;
    Boolean fragmentState = false; // True = Open : False = Close
    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        /*View view = inflater.inflate(R.layout.fragment_report, container, false);
        view.bringToFront();

        return view;*/
        return null;
    }
    public void toggleWindow(View view) {

    }

}
