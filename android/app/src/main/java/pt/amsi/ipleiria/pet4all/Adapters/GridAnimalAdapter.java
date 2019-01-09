package pt.amsi.ipleiria.pet4all.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.R;

public class GridAnimalAdapter extends BaseAdapter {
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Animal> animals;

    public GridAnimalAdapter(Context context, ArrayList<Animal> animals){
        this.context = context;
        this.animals = animals;
    }
    @Override
    public int getCount() {
        return animals.size();
    }

    @Override
    public Object getItem(int position) {return animals.get(position);}

    @Override
    public long getItemId(int position) {return position;}

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(inflater == null){
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        if(convertView == null){
            convertView = inflater.inflate(R.layout.item_animal_grid, null);
        }

        ViewHolderGrid  viewHolderGrid = (ViewHolderGrid) convertView.getTag();
        if (viewHolderGrid == null){
            viewHolderGrid = new ViewHolderGrid(convertView);
            convertView.setTag(viewHolderGrid);
        }
        viewHolderGrid.update(animals.get(position));
        return convertView;
    }
    private class ViewHolderGrid{
        private ImageView imageViewAnimal;

        public ViewHolderGrid(View convertView){
            imageViewAnimal = convertView.findViewById(R.id.imageViewAnimal);
        }

        public void update(Animal animal){
            /*Glide.with(context)
                    .load(animal.getImage())
                    .placeholder(R.drawable.error_dog)
                    .fitCenter()
                    .thumbnail(0f)
                    .diskCacheStrategy(DiskCacheStrategy.ALL)
                    .into(imageViewAnimal);*/
        }

    }
    public void refresh(ArrayList<Animal> animals){
        this.animals = animals;
        notifyDataSetChanged();
    }

}
