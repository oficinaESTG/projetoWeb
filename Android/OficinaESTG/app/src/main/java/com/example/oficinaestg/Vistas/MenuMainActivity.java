package com.example.oficinaestg.Vistas;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.view.Menu;
import android.widget.TextView;

import com.example.oficinaestg.R;
import com.google.android.material.floatingactionbutton.FloatingActionButton;
import com.google.android.material.snackbar.Snackbar;
import com.google.android.material.navigation.NavigationView;

import androidx.annotation.NonNull;
import androidx.appcompat.app.ActionBarDrawerToggle;
import androidx.fragment.app.FragmentManager;
import androidx.navigation.NavController;
import androidx.navigation.Navigation;
import androidx.navigation.ui.AppBarConfiguration;
import androidx.navigation.ui.NavigationUI;
import androidx.drawerlayout.widget.DrawerLayout;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

public class MenuMainActivity extends AppCompatActivity implements  NavigationView.OnNavigationItemSelectedListener {

    private AppBarConfiguration mAppBarConfiguration;
    private NavigationView navigationView;
    private DrawerLayout drawer;
    public static final String EMAIL_GESS = "EMAIL_GESS";
    private static final String user_email = "user_email";
    private String email = "";
    private SharedPreferences sharedPreferences;
    private SharedPreferences.Editor editor;

    private FragmentManager fragmentManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu_main);

        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        navigationView = findViewById(R.id.nav_view);
        drawer = findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer,
                toolbar, R.string.abrir, R.string.fechar);
        toggle.syncState();
        drawer.addDrawerListener(toggle);
        navigationView.setNavigationItemSelectedListener(this);
        fragmentManager = getSupportFragmentManager();

        carregarcabecalho();
    }

    //Temporário
    private void carregarcabecalho() {
        email = getIntent().getStringExtra(EMAIL_GESS);

        sharedPreferences= getSharedPreferences(user_email, Context.MODE_PRIVATE);
        
        //Email
        if (email == null){
            email=sharedPreferences.getString(user_email,getString(R.string.sem_email));
        }else if (email.length() == 0){
            System.out.println("-->"+ email.length());
            email= getString(R.string.sem_email);
        }else{
            editor = sharedPreferences.edit();
            editor.putString(user_email,email);
            editor.apply();
        }

        View hView = navigationView.getHeaderView(0);
        TextView nav_user = hView.findViewById(R.id.tv_email);
        nav_user.setText(email);
        System.out.println("-->"+ email);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onSupportNavigateUp() {
        NavController navController = Navigation.findNavController(this, R.id.nav_host_fragment);
        return NavigationUI.navigateUp(navController, mAppBarConfiguration)
                || super.onSupportNavigateUp();
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        return false;
    }
}