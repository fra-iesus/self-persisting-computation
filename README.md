# self-persisting-computation
A proof-of-concept PHP script demonstrating self-modifying code that optimizes computation by persisting results directly into its own source code.

Each time a new input is processed, the result is stored in the code itself, reducing the need for repeated expensive calculations. This approach trades increasing code size for faster execution over time — ideal for cases with complex calculations and a limited set of typical inputs.

This is an experimental idea — feel free to contribute and expand the concept!

```
➭ php compute.php
Code was updated.
Result: 120 (from calculation) in 0.258 ms
Result: 120 (from cache) in 0.004 ms
Code was updated.
Result: 3628800 (from calculation) in 0.445 ms
Result: 3628800 (from cache) in 0.001 ms
Code was updated.
Result: 2432902008176640000 (from calculation) in 0.165 ms
Result: 2432902008176640000 (from cache) in 0.001 ms
```
