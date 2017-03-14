import java.util.*;
public class Solution {

  public static void main(String[] args){
    Scanner in = new Scanner(System.in);
    int N = in.nextInt();
    String array[]=new String[N];
    for(int i=0;i<N;i++){
      array[i] = in.next();
    }

  }

  public static int ithdig(String num, int i){
    int index = num.length()-i-1;
    if(index<0)
      return 0;
    return (int)(num.charAt(index));
  }

  public static void countSort(String array[], int size, int d)
  {
    int c[]=new int[10];
    String b[]=new String[size];

    for(int i=0;i<10;i++)
      c[i]=0;

    for(int i=0;i<size;i++)
      c[ithdig(array[i],d)]++;
    for(int i=1;i<10;i++)
    c[i]=c[i]+c[i-1];
    for(int i=size-1;i>=0;i--){
      b[c[ithdig(array[i],d)]-1]=array[i];
      c[ithdig(array[i],d)]--;
    }
    for(int i=0;i<size;i++)
    array[i]=b[i];
  }
  public static void radixSort(String array[],int size, int dig){
    for(int i=1;i<=dig;i++){
      countSort(array,size,i);
    }
  }


}
