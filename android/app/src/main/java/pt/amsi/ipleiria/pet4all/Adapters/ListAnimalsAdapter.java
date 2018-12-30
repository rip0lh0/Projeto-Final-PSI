package pt.amsi.ipleiria.pet4all.Adapters;

import android.content.Context;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;

import java.util.ArrayList;
import java.util.zip.Inflater;

import pt.amsi.ipleiria.pet4all.Models.Animal;

public class ListAnimalsAdapter extends BaseAdapter {

    public Context context;
    public Inflater inflater;
    public ArrayList<Animal> listAnimals;

    @Override
    public int getCount() {
        return 0;
    }

    @Override
    public Object getItem(int i) {
        return null;
    }

    @Override
    public long getItemId(int i) {
        return 0;
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        return view;
    }

    public class ViewHolderList{

    }
}
