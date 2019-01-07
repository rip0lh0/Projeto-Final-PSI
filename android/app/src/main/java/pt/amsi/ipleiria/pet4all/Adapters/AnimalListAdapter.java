package pt.amsi.ipleiria.pet4all.Adapters;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.Models.AnimalFile;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;

public class AnimalListAdapter extends BaseAdapter {
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Animal> animals;

    public AnimalListAdapter(Context context, ArrayList<Animal> animals){
        this.context = context;
        this.animals = animals;
    }

    @Override
    public int getCount(){return animals.size();}
    @Override
    public Object getItem(int position) {
        return animals.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if(inflater == null){
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        if(convertView == null){
            convertView = inflater.inflate(R.layout.item_animal_list, null);
        }

        ViewHolderList viewHolderList = (ViewHolderList) convertView.getTag();
        if (viewHolderList == null){
            viewHolderList = new ViewHolderList(convertView);
            convertView.setTag(viewHolderList);
        }
        viewHolderList.update(animals.get(position));
        return convertView;

    }

    private class ViewHolderList{
        private TextView textViewName;
        private TextView textViewAge;
        private TextView textViewGender;
        private TextView textViewDesc;
        private ImageView imageViewAnimal;

        public ViewHolderList(View convertView){
            textViewName = convertView.findViewById(R.id.textViewName);
            textViewAge = convertView.findViewById(R.id.textViewAge);
            textViewGender = convertView.findViewById(R.id.textViewGender);
            textViewDesc = convertView.findViewById(R.id.textViewDesc);
            imageViewAnimal = convertView.findViewById(R.id.imageViewAnimal);
        }

        public void update(Animal animal, AnimalFile animalFile){
            textViewName.setText(animal.getName());
            textViewDesc.setText(String.valueOf(animal.getDescription()));
            Glide.with(context)
                    .load(animalFile.get())
                    .placeholder(R.drawable.ipl_semfundo)
                    .fitCenter()
                    .thumbnail(0f)
                    .diskCacheStrategy(DiskCacheStrategy.ALL)
                    .into(imageViewCapa);
        }

    }

    public void refresh(ArrayList<Livro> livros){
        this.livros = livros;
        notifyDataSetChanged();
    }
}
