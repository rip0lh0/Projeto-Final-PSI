package pt.amsi.ipleiria.pet4all.Adapters;
import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.bumptech.glide.load.resource.drawable.GlideDrawable;
import com.bumptech.glide.request.RequestListener;
import com.bumptech.glide.request.target.Target;

import java.util.ArrayList;
import java.util.List;

import pt.amsi.ipleiria.pet4all.ConnectionManager;
import pt.amsi.ipleiria.pet4all.Models.Animal;
import pt.amsi.ipleiria.pet4all.R;
import pt.amsi.ipleiria.pet4all.Singletons.AnimalSingleton;

public class AnimalsListApdater extends BaseAdapter {
    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Animal> animalList;

    public AnimalsListApdater(Context context, ArrayList<Animal> animals) {
        this.context = context;
        this.animalList = animals;
    }

    @Override
    public int getCount() {
        return animalList.size();
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
        if(inflater == null)inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if(view == null){
            view = inflater.inflate(R.layout.item_animal, null);
        }

        ViewHolderList viewHolderList= (ViewHolderList) view.getTag();
        if (viewHolderList == null){
            viewHolderList = new ViewHolderList(view);
            view.setTag(viewHolderList);
        }
        viewHolderList.update(animalList.get(i));
        return view;
    }

    public void refresh(ArrayList<Animal> animals){
        this.animalList = animals;
        notifyDataSetChanged();
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

        public void update(Animal animal){
            this.tvName.setText(animal.getName()+"");
            this.tvGender.setText(animal.getGender()+"");
            this.tvAge.setText(animal.getAge()+"");
            this.tvWeight.setText(animal.getWeight()+"");
            this.tvDescription.setText(animal.getDescription()+"");

            /*
            byte[] decodedString = Base64.decode(person_object.getPhoto(),Base64.NO_WRAP);
            InputStream inputStream  = new ByteArrayInputStream(decodedString);
            Bitmap bitmap  = BitmapFactory.decodeStream(inputStream);
            user_image.setImageBitmap(bitmap);
            */


            if(ConnectionManager.checkInternetConnection(context)) {
                String source_folder = "";

                source_folder = animal.getImagePath();

                if(source_folder == null) return;

                String source_path = "http://192.168.1.198/v1/animal/download-image?source_path=" + source_folder;

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

