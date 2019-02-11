package pt.amsi.ipleiria.pet4all.Adapters;
import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.bumptech.glide.load.resource.drawable.GlideDrawable;
import com.bumptech.glide.request.RequestListener;
import com.bumptech.glide.request.target.Target;

import java.util.ArrayList;

import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.Models.KennelAnimal;
import pt.amsi.ipleiria.pet4all.R;

public class AnimalsListAdapter extends BaseAdapter {
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<KennelAnimal> arrListKennelAnimals;

    public AnimalsListAdapter(Context context, ArrayList<KennelAnimal> kennelAnimals) {
        this.context = context;
        this.arrListKennelAnimals = kennelAnimals;
    }

    @Override
    public int getCount() {
        return arrListKennelAnimals.size();
    }

    @Override
    public KennelAnimal getItem(int i) {
        return arrListKennelAnimals.get(i);
    }

    @Override
    public long getItemId(int i) {
        return arrListKennelAnimals.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        if(inflater == null)inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if(view == null){
            view = inflater.inflate(R.layout.item_animal, null);
        }

        ViewHolderList viewHolderList= (ViewHolderList) view.getTag();
        if (viewHolderList == null){
            viewHolderList = new ViewHolderList(view);
            view.setTag(viewHolderList);
        }
        viewHolderList.update(arrListKennelAnimals.get(i));
        return view;
    }

    public void refresh(ArrayList<KennelAnimal> kennelAnimals){
        this.arrListKennelAnimals = kennelAnimals;
        this.notifyDataSetChanged();
    }

    private class ViewHolderList{
        private TextView tvName;
        private TextView tvGender;
        private TextView tvAge;
        private TextView tvWeight;
        private TextView tvDescription;
        private ImageView image;
        private ProgressBar progressBar;


        public ViewHolderList(View view){
            this.tvName = view.findViewById(R.id.animal_name);
            this.tvGender = view.findViewById(R.id.animal_gender);
            this.tvAge = view.findViewById(R.id.animal_age);
            this.tvWeight = view.findViewById(R.id.animal_weight);
            this.tvDescription = view.findViewById(R.id.animal_decription);
            this.image = view.findViewById(R.id.animal_img);
            this.progressBar = view.findViewById(R.id.animal_image_progressBar);
        }

        public void update(KennelAnimal kennelAnimal){
            Animal tempAnimal = kennelAnimal.getAnimal();

            this.tvName.setText(tempAnimal.getName()+"");
            this.tvGender.setText(tempAnimal.getGender()+"");
            if(tempAnimal.getGender().charAt(0) == 'F') this.tvGender.setBackgroundResource(R.color.color_female);
            else this.tvGender.setBackgroundResource(R.color.color_male);

            this.tvAge.setText(tempAnimal.getAge()+"");
            if(tempAnimal.getAge() == 0) this.tvAge.setText("-");
            if(tempAnimal.getGender().charAt(0) == 'F') this.tvAge.setBackgroundResource(R.color.color_female);
            else this.tvAge.setBackgroundResource(R.color.color_male);

            this.tvWeight.setText(tempAnimal.getWeight()+"");
            if(tempAnimal.getWeight() == 0) this.tvWeight.setText("-");
            if(tempAnimal.getGender().charAt(0) == 'F') this.tvWeight.setBackgroundResource(R.color.color_female);
            else this.tvWeight.setBackgroundResource(R.color.color_male);

            this.tvDescription.setText(tempAnimal.getDescription()+"");



            if(ConnectionManager.checkInternetConnection(context)) {
                String source_folder = "";

                source_folder = kennelAnimal.getKennel().getId() + "/" + kennelAnimal.getCreated_at() + "/0.jpg" ;

                if(source_folder == null) return;

                String source_path = ConnectionManager.PREFIX_URL + "animal/download-image?source_path=" + source_folder;

                Log.e("IMAGES_PATH", source_path);

                progressBar.setVisibility(View.VISIBLE);
                Glide.with(context)
                    .load(source_path)
                    .fitCenter()
                    .listener(new RequestListener<String, GlideDrawable>() {
                        @Override
                        public boolean onException(Exception e, String model, Target<GlideDrawable> target, boolean isFirstResource) {
                            progressBar.setVisibility(View.GONE);
                            return false;
                        }

                        @Override
                        public boolean onResourceReady(GlideDrawable resource, String model, Target<GlideDrawable> target, boolean isFromMemoryCache, boolean isFirstResource) {
                            progressBar.setVisibility(View.GONE);
                            return false;
                        }
                    })
                    .error(R.drawable.ic_no_image)
                    .diskCacheStrategy(DiskCacheStrategy.ALL)
                    .into(image);
            }else{
                Glide.with(context)
                    .load(R.drawable.ic_no_image)
                    .placeholder(R.drawable.ic_no_image)
                    .into(image);
            }

        }


    }
}

