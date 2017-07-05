#include <stdio.h>
#include <stdlib.h>

int main() {

  FILE *arquivo = fopen("bat.txt", "w");
  int i = 0;

  for(i = 1; i < 145; i++){
    fprintf(arquivo, "['%d', %d, %d],\n", i, rand()%50 + 100, rand()%50 + 60);
  }

  fclose(arquivo);
  return 0;
}
