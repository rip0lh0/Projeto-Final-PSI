package pt.amsi.ipleiria.pet4all.Adapters;
import android.content.Context;
import android.graphics.Color;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;

import java.util.List;

import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.R;

public class AnimalsListApdater extends RecyclerView.Adapter<AnimalsListApdater.AnimalViewHolder> {



    private Context mCtx;
    private List<Animal> animalList;

    public AnimalsListApdater(Context mCtx, List<Animal> animalList){
        this.mCtx=mCtx;
        this.animalList=animalList;
    }

    @Override
    public AnimalViewHolder onCreateViewHolder (ViewGroup parent,int viewType){
        LayoutInflater inflater=LayoutInflater.from(mCtx);
        View view = inflater.inflate(R.layout.animal_list,null);
        return new AnimalViewHolder(view);

    }


    @Override
    public void onBindViewHolder(AnimalViewHolder holder,int position) {
        Animal animal= animalList.get(position);
        String gender="Macho";
        if (animal.getGender() == 'F'){
            gender = "Fêmea";

        }

        Glide.with(mCtx)
                .load("@drawable/error_dog")
                .into(holder.imageView);
        holder.textViewName.setText(animal.getName());
        holder.textViewDescription.setText(animal.getDescription());
        holder.textViewGender.setText(gender);
        holder.textViewAge.setText(String.valueOf(animal.getAge()));
    }

    @Override
    public int getItemCount() {
        return animalList.size();
    } 
class AnimalViewHolder extends RecyclerView.ViewHolder {

    TextView textViewName, textViewGender, textViewDescription, textViewAge;
    ImageView imageView;

    public AnimalViewHolder(View itemView) {
        super(itemView);

        textViewName = itemView.findViewById(R.id.textViewName);
        textViewGender = itemView.findViewById(R.id.textViewGender);
        textViewDescription = itemView.findViewById(R.id.textViewDescription);
        textViewAge = itemView.findViewById(R.id.textViewAge);
        imageView = itemView.findViewById(R.id.imageView);
    }
}

}

